<?php

namespace Ghasedaksms\GhasedaksmsLaravel\Message;

class GhasedaksmsMessage
{
    private $lineNumber;
    private $receptor;
    private $message;
    private $sendDate;
    private $clientReferenceId = null;
    private $udh = false;

    /**
     * @param $lineNumber
     * @param $receptor
     * @param $message
     * @param $sendDate
     * @param $clientReferenceId
     * @param $udh
     */
    public function __construct()
    {
    }

    /**
     * @return mixed
     */
    public function getMessage()
    {
        return $this->message;
    }

    /**
     * @param mixed $message
     * @return GhasedaksmsMessage
     */
    public function setMessage($message)
    {
        $this->message = $message;
        return $this;
    }

    /**
     * @return mixed
     */
    public function getLineNumber()
    {
        return $this->lineNumber;
    }

    /**
     * @param mixed $lineNumber
     * @return GhasedaksmsMessage
     */
    public function setLineNumber($lineNumber)
    {
        $this->lineNumber = $lineNumber;
        return $this;
    }

    /**
     * @return mixed
     */
    public function getReceptor()
    {
        return $this->receptor;
    }

    /**
     * @param mixed $receptor
     * @return GhasedaksmsMessage
     */
    public function setReceptor($receptor)
    {
        $this->receptor = $receptor;
        return $this;
    }

    /**
     * @return mixed
     */
    public function getSendDate()
    {
        return $this->sendDate;
    }

    /**
     * @param mixed $sendDate
     * @return GhasedaksmsMessage
     */
    public function setSendDate($sendDate)
    {
        $this->sendDate = $sendDate;
        return $this;
    }

    public function getClientReferenceId(): null
    {
        return $this->clientReferenceId;
    }

    public function setClientReferenceId(null $clientReferenceId): GhasedaksmsMessage
    {
        $this->clientReferenceId = $clientReferenceId;
        return $this;
    }

    public function isUdh(): bool
    {
        return $this->udh;
    }

    public function setUdh(bool $udh): GhasedaksmsMessage
    {
        $this->udh = $udh;
        return $this;
    }

    public function toArray()
    {
        return [
            'lineNumber' => $this->lineNumber,
            'sendDate' => $this->sendDate->format('c'),
            'receptor' => $this->receptor,
            'message' => $this->message,
            'clientReferenceId' => $this->clientReferenceId,
            'udh' => $this->udh
        ];
    }

}