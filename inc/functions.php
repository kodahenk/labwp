<?php

if (!defined('ABSPATH')) {
  die('are you bad boy/girl :(');
}

/**
 * Sitede kullanılacak php fonksiyonları
 */


/**
 * asset klasörünün url path'ini verir
 *
 * @param string $assetFile eğer bol ise asset/ klasörünün path'ini verir, parametre alırsa aldığı parametreyi asset klasörüne ekler.
 * @return string
 */
function getThemeAssets(string $assetFile = ''): string
{
  // boşlukları sil
  $assetFile = trim($assetFile);
  // / karakterlerini sil
  $assetFile = ltrim($assetFile, '/');

  if ($assetFile == '') {
    return _DO_URL . '/assets/';
  } else {
    return _DO_URL . '/assets/' . $assetFile;
  }
}

/**
 * getThemeAssets() fonsksiyonunu return eder, bu fonksiyon ise echo eder 
 *
 * @param string $assetFile
 * @return void
 */
function theThemeAssets(string $assetFile = ''): void
{
  echo getThemeAssets($assetFile);
}

/**
 * Ekrana ya da log dosyasına bilgi basar
 *
 * @param mixed $arg ekrana basılacak bilgi
 * @param mixed $title ekrana basılırken kullanılacak başlık
 * @param boolean $isDie true ise bu satırdan sonra dalışma, die yapar
 * @param boolean $log false dışında bir değerde aldığı string değere göre ekrana basmak yerine bir log dosyası oluşturup içine basar
 * @return void
 */
function pr(mixed $arg = '', mixed $title = '', bool $isDie = false, bool $log = false)
{
  if ($arg === false) {
    $arg = 'false';
  } elseif ($arg === true) {
    $arg = 'true';
  }

  $divStyle = 'style="
      border: 1px solid #0f2b46;
      margin: 10px;
      background-color: #f2f5f9;
      border-radius: 0.2rem;
      margin-top: 0px;
    "';
  $preStyle = 'style="
      font-size: 0.9rem !important;
      color: black;
      font-family: monospace;
      background: #f2f5f9;
      text-wrap: wrap;
      margin: 10px;
      line-height: 1.1rem;
    "';
  $h3Style = 'style="
      font-family: monospace;
      background: black;
      font-size: 1.2rem;
      padding: 10px;
      margin: 0;
      color: white;
    "';

  $logString = '';

  $logString .= "<div {$divStyle}>";

  if (trim($title) !== '') {
    $logString .= "<h3  {$h3Style}>" . $title . '</h3>';
  }

  $logString .= "<pre  {$preStyle}>";

  if ($isDie) {
    $logString .= print_r($arg, true);
    exit;
  } else {
    $logString .= print_r($arg, true);
  }

  $logString .= '</pre>';
  $logString .= '</div>';

  echo $logString;
}
