<?php
/**
 * Created by Carl Owens (carl@partfire.co.uk)
 * Company: PartFire Ltd (www.partfire.co.uk)
 * Copyright © 2016 PartFire Ltd. All rights reserved.
 *
 * User:    Carl Owens
 * Date:    22/12/2016
 * Time:    20:47
 * File:    MessageInterface.php
 **/

namespace PartFire\SlackBundle\Models;

interface MessageInterface
{
    public function send($message, $channel, $icon);
}
