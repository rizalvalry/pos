<?php

function check_already_login()
{
    $ci = &get_instance();
    $user_session = $ci->session->userdata('userid');
    if ($user_session) {
        redirect('home');
    }
}


function check_not_login()
{
    $ci = &get_instance();
    $user_session = $ci->session->userdata('userid');
    if (!$user_session) {
        redirect('login');
    }
}

function check_admin()
{
    $ci = &get_instance();
    $ci->load->library('fungsi');
    if ($ci->fungsi->user_login()->level != 1) {
        redirect('dashboard');
    }
}

function indo_currency($nominal)
{
    $result = "Rp " . number_format($nominal, 2, ',', '.');
    return $result;
}

function indo_date($date)
{
    $d = substr($date, 8, 2);
    $m = substr($date, 5, 2);
    $y = substr($date, 0, 4);

    return $d . '/' . $m . '/' . $y;
}

function getRomawi($bln){

    switch ($bln){

              case 1:

                  return "I";

                  break;

              case 2:

                  return "II";

                  break;

              case 3:

                  return "III";

                  break;

              case 4:

                  return "IV";

                  break;

              case 5:

                  return "V";

                  break;

              case 6:

                  return "VI";

                  break;

              case 7:

                  return "VII";

                  break;

              case 8:

                  return "VIII";

                  break;

              case 9:

                  return "IX";

                  break;

              case 10:

                  return "X";

                  break;

              case 11:

                  return "XI";

                  break;

              case 12:

                  return "XII";

                  break;

        }

 }
 function terbilang($x) {
    $angka = ["", "Satu", "Dua", "Tiga", "Empat", "Lima", "Enam", "Tujuh", "Delapan", "Sembilan", "Sepuluh", "Sebelas"];
  
    if ($x < 12)
      return " " . $angka[$x];
    elseif ($x < 20)
      return terbilang($x - 10) . " Belas";
    elseif ($x < 100)
      return terbilang($x / 10) . " Puluh" . terbilang($x % 10);
    elseif ($x < 200)
      return "Seratus" . terbilang($x - 100);
    elseif ($x < 1000)
      return terbilang($x / 100) . " Ratus" . terbilang($x % 100);
    elseif ($x < 2000)
      return "Seribu" . terbilang($x - 1000);
    elseif ($x < 1000000)
      return terbilang($x / 1000) . " Ribu" . terbilang($x % 1000);
    elseif ($x < 1000000000)
      return terbilang($x / 1000000) . " Juta" . terbilang($x % 1000000);
  }

  if (!function_exists('dd')) {
    function dd()
     {
         echo '<pre>';
         array_map(function($x) {var_dump($x);}, func_get_args());
         die;
      }
    }