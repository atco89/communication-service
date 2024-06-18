<?php

namespace App\Controller;

use App\Dto\CallDto;
use App\Dto\SmsDto;
use App\Form\CallFormType;
use App\Form\SmsFormType;
use App\Service\Caller;
use App\Service\CheapSmsAndCalls;
use App\Service\Enum\ServiceProvider;
use App\Service\Factory\SmsFactory;
use Exception;
use InvalidArgumentException;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

#[Route(path: 'service')]
class CommunicationController extends AbstractController
{

    #[Route(path: '/sms/{provider}', name: 'service_sms', methods: ['GET', 'POST'])]
    public function sms(Request $request, string $provider): Response
    {
        $smsDto = new SmsDto();

        $form = $this->createForm(type: SmsFormType::class, data: $smsDto);
        $form->handleRequest(request: $request);

        if ($form->isSubmitted() && $form->isValid()) {
            try {
                $service = SmsFactory::build(serviceProvider: ServiceProvider::tryFrom(value: $provider));
                $message = $service->sendSMS(from: $smsDto->getFrom(), to: $smsDto->getTo(), text: $smsDto->getText());
                $this->addFlash(type: 'success', message: $message);
            } catch (Exception $exception) {
                $this->addFlash(type: 'error', message: $exception->getMessage());
            }
        }

        return $this->render(view: 'sms/index.html.twig', parameters: [
            'form' => $form->createView(),
            'provider' => $provider
        ]);
    }

    #[Route(path: '/call/{provider}', name: 'service_call', methods: ['GET', 'POST'])]
    public function call(Request $request, string $provider): Response
    {
        $callDto = new CallDto();

        $form = $this->createForm(type: CallFormType::class, data: $callDto);
        $form->handleRequest(request: $request);

        if ($form->isSubmitted() && $form->isValid()) {
            try {
                $serviceProvider = ServiceProvider::tryFrom(value: $provider);

                if ($serviceProvider === ServiceProvider::CALLER) {
                    $message = (new Caller())->startCall(from: $callDto->getFrom(), to: $callDto->getTo());
                } elseif ($serviceProvider === ServiceProvider::CHEAP_SMS_AND_CALLS) {
                    $message = (new CheapSmsAndCalls())->call(from: $callDto->getFrom(), to: $callDto->getTo());
                } else {
                    throw new InvalidArgumentException(message: 'Invalid service provider!');
                }

                $this->addFlash(type: 'success', message: $message);
            } catch (Exception $exception) {
                $this->addFlash(type: 'error', message: $exception->getMessage());
            }
        }

        return $this->render(view: 'call/index.html.twig', parameters: [
            'form' => $form->createView(),
            'provider' => $provider
        ]);
    }
}