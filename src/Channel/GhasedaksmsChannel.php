<?php

namespace Ghasedaksms\GhasedaksmsLaravel\Channel;

use Exception;
use Ghasedak\DataTransferObjects\Request\OtpMessageDTO;
use Ghasedak\DataTransferObjects\Request\SingleMessageDTO;
use Ghasedak\DataTransferObjects\Response\OtpMessageResponseDTO;
use Ghasedak\DataTransferObjects\Response\SingleMessageResponseDTO;
use Ghasedak\Exceptions\GhasedakSMSException;
use Ghasedak\GhasedaksmsApi;
use Ghasedaksms\GhasedaksmsLaravel\Message\GhasedaksmsMessage;
use Ghasedaksms\GhasedaksmsLaravel\Message\GhasedaksmsVerifyLookUp;

class GhasedaksmsChannel
{
    /**
     * The Ghasedaksms client instance.
     *
     * @var GhasedaksmsApi
     */
    protected $ghasedaksms;
    /**
     * The phone number notifications should be sent from.
     *
     * @var string
     */
    protected $from;

    public function __construct(GhasedaksmsApi $ghasedaksms, $from = null)
    {
        $this->from = $from;
        $this->ghasedaksms = $ghasedaksms;
    }

    /**
     * @throws GhasedakSMSException
     * @throws Exception
     */
    public function send($notifiable, $notification): OtpMessageResponseDTO|SingleMessageResponseDTO
    {
        $message = $notification->toGhasedaksms($notifiable);

        return match (get_class($message)) {
            GhasedaksmsMessage::class => $this->sendSingle($message),
            GhasedaksmsVerifyLookUp::class => $this->sendVerifyLookup($message),
            default => throw new Exception('Method not found')
        };
    }

    /**
     * @param GhasedaksmsMessage $message
     * @return SingleMessageResponseDTO
     * @throws GhasedakSMSException
     */
    public function sendSingle(GhasedaksmsMessage $message): SingleMessageResponseDTO
    {
        $singleMessage = new SingleMessageDTO(
            $message->getSendDate(),
            $message->getLineNumber(),
            $message->getReceptor(),
            $message->getMessage(),
            $message->getClientReferenceId(),
        );

        return $this->ghasedaksms->sendSingle($singleMessage);
    }

    /**
     * @param GhasedaksmsVerifyLookUp $message
     * @return OtpMessageResponseDTO
     * @throws GhasedakSMSException
     */
    public function sendVerifyLookup(GhasedaksmsVerifyLookUp $message): OtpMessageResponseDTO
    {
        $message = new OtpMessageDTO(
            $message->getSendDate(),
            $message->getReceptors(),
            $message->getTemplateName(),
            $message->getInputs(),
            $message->isUdh()
        );

        return $this->ghasedaksms->sendOtp($message);
    }

}
