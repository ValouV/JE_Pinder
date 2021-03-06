<?php

namespace EPFProjets\ProfileBundle\Repository;

use Symfony\Component\Validator\Constraints\DateTime;
/**
 * ProfileRepository
 *
 * This class was generated by the Doctrine ORM. Add your own custom
 * repository methods below.
 */
class ProfileRepository extends \Doctrine\ORM\EntityRepository
{

  public function getPageAcc(){
    $qb = $this->createQueryBuilder('a');

    $qb -> orderBy('a.nbreVues', 'DESC')
        -> setMaxResults( 10 );

    return $qb
    ->getQuery()
    ->getResult()
  ;
  }

  public function getRecherche($data){
    $qb = $this->createQueryBuilder('a');
    $qb ->innerJoin('a.user', 'c')
        ->addSelect('c')
        ;
    if($data['sexe'] != '*'){
    $qb -> where('c.sexe = :usexe')
          -> setParameter('usexe', $data['sexe']);
    }
    if($data['region'] != '*'){
    $qb -> where('a.region = :aregion')
        -> setParameter('aregion', $data['region']);

    }
    if($data['name'] != ''){
      $qb -> where('c.name = :uname')
          -> setParameter('uname', $data['name']);
    }
    if($data['surname'] != ''){
      $qb -> where('c.surname = :usurname')
          -> setParameter('usurname', $data['surname']);
    }

    $qb -> orderBy('a.nbreVues', 'DESC');

    $results = $qb
    ->getQuery()
    ->getResult()
  ;

    if($data['age'] != '*'){

      $nev = $this->yearstodate($data['age']);

      $nev_dt = new \DateTime($nev);
      $borne = $data['age']+20;

      if($data['age']=='60'){$borne = $borne + 100;}
      $anc = $this->yearstodate($borne);
      $anc_dt = new \DateTime($anc);

      $data = array();

      foreach ($results as $result) {
      $birthdate = $result->getUser()->getBirthdate();
          if (($birthdate > $anc_dt) and ($birthdate < $nev_dt)) {
            array_push($data, $result);
          }
      }
  return $data;
  }

  return $results = $qb
  ->getQuery()
  ->getResult()
;


  }

  function yearstodate($years) {

          $now = date("Y-m-d");
          $now = explode('-', $now);
          $year = $now[0];
          $month   = $now[1];
          $day  = $now[2];
          $converted_year = $year - $years;
          return $now = $converted_year."-".$month."-".$day;

  }

}
