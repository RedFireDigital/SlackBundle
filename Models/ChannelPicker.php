<?php
/**
 * Created by Carl Owens (carl@partfire.co.uk)
 * Company: PartFire Ltd (www.partfire.co.uk)
 * Copyright © 2016 PartFire Ltd. All rights reserved.
 *
 * User:    Carl Owens
 * Date:    23/12/2016
 * Time:    15:06
 * File:    ChannelPicker.php
 **/

namespace PartFire\SlackBundle\Models;

class ChannelPicker
{
    protected $environment;

    protected $testingChannelName;

    public function __construct($environment = 'dev', $testingChannelName = 'dev-tests')
    {
        $this->environment = $environment;
        $this->testingChannelName = $testingChannelName;
    }

    public function getChannel($channel)
    {
        if ($this->environment != 'prod')
            return $this->testingChannelName;
        return $channel;
    }
}
