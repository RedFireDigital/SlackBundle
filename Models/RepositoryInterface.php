<?php
/**
 * Created by PhpStorm.
 * User: carl
 * Date: 19/09/18
 * Time: 12:09
 */

namespace PartFire\SlackBundle\Models;

interface RepositoryInterface
{
    public function findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null);
}
