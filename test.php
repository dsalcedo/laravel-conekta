<?php
require __DIR__.'/vendor/autoload.php';
use LaravelConekta\Pago;

header("Cache-Control: no-transform,public,max-age=1,s-maxage=1");
header('Content-Type: application/json');

$orden = [
    'amount'      => 100 * 100,
    'currency'    => 'mxn',
    'description' => 'Boletos de Cine CineChido',
    'customer_info'     => [
        'name'  => 'Daniel Salcedo',
        'phone' => '7771223344',
        'email' => 'laboratorio@backapp.com.mx'
    ],
    'line_items' => [
        [
            'name'        => 'Pantalla',
            'description' => 'Pantalla 4k para jugar juegos jugables chidos perrones :v',
            'unit_price'  => 100 * 100,
            'quantity'    => 1,
            'sku'         => 'PANTALLA4k0001'
        ]
    ]
];
$tokenTarjeta = 'tok_test_visa_4242';

$pago = new Pago();
$respuesta = null;
//$respuesta = $pago->conTarjeta($orden, $tokenTarjeta);
//$respuesta = $pago->conBanorte($orden, $tokenTarjeta);
//$respuesta = $pago->conSpei($orden);
//
//$fechaLimiteDePago = '2017-04-30 23:59:59';
//$respuesta = $pago->conOxxoPay($orden, $fechaLimiteDePago);
//
//$mensualidades = 3;
//$respuesta = $pago->aMesesSinIntereses($orden, $mensualidades, $tokenTarjeta);
//$respuesta = $pago->msi($orden, $mensualidades, $tokenTarjeta);
echo json_encode($respuesta);