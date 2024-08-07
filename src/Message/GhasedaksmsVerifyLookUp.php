<?php

namespace Ghasedaksms\GhasedaksmsLaravel\Message;

class GhasedaksmsVerifyLookUp
{
    private $receptors;
    private $sendDate;
    private $templateName;
    private $inputs;
    private $udh = false;

    public function __construct()
    {
    }

    /**
     * @return mixed
     */
    public function getReceptors()
    {
        return $this->receptors;
    }

    /**
     * @param mixed $receptors
     * @return GhasedaksmsVerifyLookUp
     */
    public function setReceptors($receptors)
    {
        $this->receptors = $receptors;
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
     * @return GhasedaksmsVerifyLookUp
     */
    public function setSendDate($sendDate)
    {
        $this->sendDate = $sendDate;
        return $this;
    }

    /**
     * @return mixed
     */
    public function getTemplateName()
    {
        return $this->templateName;
    }

    /**
     * @param mixed $templateName
     * @return GhasedaksmsVerifyLookUp
     */
    public function setTemplateName($templateName)
    {
        $this->templateName = $templateName;
        return $this;
    }

    /**
     * @return mixed
     */
    public function getInputs()
    {
        return $this->inputs;
    }

    /**
     * @param mixed $inputs
     * @return GhasedaksmsVerifyLookUp
     */
    public function setInputs($inputs)
    {
        $this->inputs = $inputs;
        return $this;
    }

    public function isUdh(): bool
    {
        return $this->udh;
    }

    public function setUdh(bool $udh): GhasedaksmsVerifyLookUp
    {
        $this->udh = $udh;
        return $this;
    }

    public function toArray()
    {
        return [
            'sendDate' => $this->sendDate,
            'receptors' => $this->receptors,
            'templateName' => $this->templateName,
            'inputs' => $this->inputs,
            'udh' => $this->udh
        ];
    }
}