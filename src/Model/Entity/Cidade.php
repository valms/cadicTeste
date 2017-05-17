<?php
namespace App\Model\Entity;

use Cake\ORM\Entity;

/**
 * Cidade Entity
 *
 * @property int $id
 * @property int $estado_id
 * @property string $nome
 *
 * @property \App\Model\Entity\Estado $estado
 */
class Cidade extends Entity
{

}
