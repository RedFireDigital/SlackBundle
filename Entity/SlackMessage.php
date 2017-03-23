<?php

/**
 * Created by Graham Owens (gra@partfire.co.uk)
 * Company: PartFire Ltd (www.partfire.co.uk)
 * Console: Discovery
 *
 * User:    gra
 * Date:    22/03/17
 * Time:    23:06
 * Project: fruitful-property-investments
 * File:    SlackMessage.php
 *
 **/

namespace PartFire\SlackBundle\Entity;

use Doctrine\ORM\Mapping as ORM;
use Doctrine\ORM\Mapping\MappedSuperclass;
use Gedmo\Mapping\Annotation as Gedmo;
use Doctrine\Common\Collections\ArrayCollection;
use JMS\Serializer\Annotation\ExclusionPolicy;
use JMS\Serializer\Annotation\Expose;
use PartFire\CommonBundle\Entity\CommonBaseEntity;

/**
 * @ORM\Entity
 * @ORM\Table(name="partfire_slack_messsages", indexes={
 *  @ORM\Index(name="index_enabled", columns={"enabled", "deleted", "has_sent"}) })
 * @ORM\Entity(repositoryClass="PartFire\SlackBundle\Entity\Repository\SlackMessageRepository")
 * @ExclusionPolicy("all")
 */

class SlackMessage extends CommonBaseEntity
{
    /**
     * @ORM\Column(name="message",type="text", nullable=false);
     *
     */

    protected $message;

    /**
     * @ORM\Column(name="chanel",type="string", length=255, unique=false, nullable=false);
     *
     */

    protected $channel;

    /**
     * @ORM\Column(name="icon",type="string", length=255, unique=false, nullable=false);
     *
     */

    protected $icon;

    /**
     * @ORM\Column(type="boolean", name="actioned", options={"comment" = "Enable/Disable flag"});
     */

    protected $actioned;

    /**
     * @ORM\Column(type="boolean", name="has_sent", options={"comment" = "Enable/Disable flag"});
     */

    protected $hasSent;

    /**
     * @ORM\Column(name="response",type="string", length=255, unique=false, nullable=true);
     */

    protected $response;


    public function __construct()
    {
        $this->actioned = false;
        $this->hasSent = false;
        parent::__construct();
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
     */
    public function setMessage($message)
    {
        $this->message = $message;
    }

    /**
     * @return mixed
     */
    public function getChannel()
    {
        return $this->channel;
    }

    /**
     * @param mixed $channel
     */
    public function setChannel($channel)
    {
        $this->channel = $channel;
    }

    /**
     * @return mixed
     */
    public function getIcon()
    {
        return $this->icon;
    }

    /**
     * @param mixed $icon
     */
    public function setIcon($icon)
    {
        $this->icon = $icon;
    }

    /**
     * @return mixed
     */
    public function getHasSent()
    {
        return $this->hasSent;
    }

    /**
     * @param mixed $hasSent
     */
    public function setHasSent($hasSent)
    {
        $this->hasSent = $hasSent;
    }

    /**
     * @return mixed
     */
    public function getResponse()
    {
        return $this->response;
    }

    /**
     * @param mixed $response
     */
    public function setResponse($response)
    {
        $this->response = $response;
    }

    /**
     * @return mixed
     */
    public function getActioned()
    {
        return $this->actioned;
    }

    /**
     * @param mixed $actioned
     */
    public function setActioned(bool $actioned)
    {
        $this->actioned = $actioned;
    }


}
