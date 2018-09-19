<?php

/**
 * Created by Graham Owens (gra@partfire.co.uk)
 * Company: PartFire Ltd (www.partfire.co.uk)
 * Console: Discovery
 *
 * User:    gra
 * Date:    22/03/17
 * Time:    23:17
 * Project: fruitful-property-investments
 * File:    SlackMessageRepository.php
 *
 **/

namespace PartFire\SlackBundle\Entity\Repository;

use PartFire\CommonBundle\Entity\Repository\RepositoryAbstract;
use PartFire\SlackBundle\Models\RepositoryInterface;

class SlackMessageRepository extends RepositoryAbstract implements RepositoryInterface
{
    public function findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
    {
        return $this->findBy($criteria, $orderBy, $limit, $offset);
    }
}