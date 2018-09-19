<?php
/**
 * Created by Graham Owens (gra@partfire.co.uk)
 * Company: PartFire Ltd (www.partfire.co.uk)
 * Console: Discovery
 *
 * User:    gra
 * Date:    23/03/17
 * Time:    02:05
 * Project: fruitful-property-investments
 * File:    SlackRepositoryFactory.php
 *
 **/

namespace PartFire\SlackBundle\Entity\Repository;


use PartFire\CommonBundle\Entity\Repository\Repository;
use PartFire\CommonBundle\Entity\Repository\RepositoryBaseFactory;
use PartFire\SlackBundle\Models\RepositoryInterface;

class SlackRepositoryFactory extends RepositoryBaseFactory implements Repository
{
    public $bundleName = "PartFireSlackBundle";

    public function getBundleName()
    {
        return $this->bundleName;
    }

    public function getEntityManagerName()
    {
        return $this->entityManagerName;
    }
}
