<?php

namespace AppBundle\Entity\Vote;

use Doctrine\ORM\EntityRepository;
use Doctrine\ORM\Mapping\ClassMetadata;
use AppBundle\Entity\Adherent;
use AppBundle\Entity\Organ\Organ;
use AppBundle\Entity\Organ\OrganType;
use AppBundle\Entity\Text\TextGroup;

/**
 * ContributionRepository
 *
 * This class was generated by the Doctrine ORM. Add your own custom
 * repository methods below.
 */
class OrganVoteRuleRepository extends EntityRepository
{
    protected $classname;

    public function getOrganTypeRightToVoteForTextGroup(OrganType $organType, TextGroup $textGroup)
    {
        $voteRightCount = $this->createQueryBuilder('ovr')
            ->select('COUNT(ovr)')
            ->leftJoin('ovr.concernedOrganType', 'organtypes')
            ->where('ovr.textGroup = :textGroup')
            ->andWhere('organtypes.id = :organType OR SIZE(ovr.concernedOrganType) = 0')
            ->setParameter('organType', $organType->getId())
            ->setParameter('textGroup', $textGroup->getId())
            ->getQuery()->getSingleScalarResult();

        return !!$voteRightCount;
    }
    public function getAdherentRightToReportForOrganAndTextGroup(Adherent $adherent, Organ $organ, TextGroup $textGroup)
    {
        // FIXME : does not handle the cas where everybody in the organ has the right to report
        // a vote (case where SIZE(reportResponsability) = 0)
        // FIXME : a adherent as to be designated by its organ to be considered as able to
        // report
        $voteRightCount = $this->createQueryBuilder('ovr')
            ->select('COUNT(ovr)')
            ->leftJoin('ovr.reportResponsability', 'rr')
            ->leftJoin('rr.adherentResponsabilities', 'adhresp')
            ->where('ovr.textGroup = :textGroup')
            ->andWhere('adhresp.adherent = :adherent AND adhresp.designatedByOrgan = :organ')
            ->setParameter('organ', $organ->getId())
            ->setParameter('textGroup', $textGroup->getId())
            ->setParameter('adherent', $adherent->getId())
            ->getQuery()->getSingleScalarResult();

        return !!$voteRightCount;
    }
}
