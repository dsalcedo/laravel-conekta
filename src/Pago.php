<?php
namespace LaravelConekta;
use Conekta\Conekta;
use Conekta\Order;
use Exception;

class Pago {

    public function configuracion()
    {
        $apiKey = config('conekta.api_key');
        $version= config('conekta.version');
        $locale = config('conekta.locale');

        Conekta::setApiKey($apiKey);
        Conekta::setApiVersion($version);
        Conekta::setLocale($locale);

        return;
    }

    private function respuesta()
    {
        return [
            'error' => false,
            'error_mensaje' => null,
            'conekta' => []
        ];
    }

    public function conTarjeta($orden, $tokenTarjeta)
    {
        $this->configuracion();
        $respuesta = $this->respuesta();

        $orden['charges'][] = [
            'payment_method' => [
                'token_id' => $tokenTarjeta,
                'type'     => 'card'
            ]
        ];

        try {
            $respuesta['conekta'] = Order::create($orden);
        } catch (Exception $e) {
            $respuesta = [
                'error' => true,
                'error_mensaje' => $e->getMessage()
            ];
        }

        return $respuesta;
    }

    public function conBanorte($orden, $tokenTarjeta)
    {
        $this->configuracion();
        $respuesta = $this->respuesta();

        $orden['charges'][] = [
            'payment_method' => [
                'token_id' => $tokenTarjeta,
                'type'     => 'banorte'
            ]
        ];

        try {
            $respuesta['conekta'] = Order::create($orden);
        } catch (Exception $e) {
            $respuesta = [
                'error' => true,
                'error_mensaje' => $e->getMessage()
            ];
        }

        return $respuesta;
    }

    public function conSpei($orden)
    {
        $this->configuracion();
        $respuesta = $this->respuesta();

        $orden['charges'][] = [
            'payment_method' => [
                'type'     => 'spei'
            ]
        ];

        try {
            $respuesta['conekta'] = Order::create($orden);
        } catch (Exception $e) {
            $respuesta = [
                'error' => true,
                'error_mensaje' => $e->getMessage()
            ];
        }

        return $respuesta;
    }

    public function conOxxoPay($orden, $fechaLimiteDePago = null)
    {
        $this->configuracion();
        $respuesta = $this->respuesta();

        if(!is_null($fechaLimiteDePago)){
            $paymentOrder['charges'][] = [
                'payment_method' => [
                    'type'       => 'oxxo_cash',
                    'expires_at' => strtotime( date($fechaLimiteDePago) )
                ]
            ];

            try {
                $respuesta['conekta'] = Order::create($orden);
            } catch (Exception $e) {
                $respuesta = [
                    'error' => true,
                    'error_mensaje' => $e->getMessage()
                ];
            }

        }else{
            $respuesta = [
                'error' => true,
                'error_mensaje' => 'Es necesario especificar una fecha límite de pago en formato: Y-m-d H:i:s'
            ];
        }

        return $respuesta;
    }

    public function aMesesSinIntereses($orden, $mensualidades, $tokenTarjeta)
    {
        $this->configuracion();
        $respuesta = $this->respuesta();

        $orden['charges'][] = [
            'payment_method' => [
                'monthly_installments' => $mensualidades,
                'token_id' => $tokenTarjeta,
                'type'     => 'card'
            ]
        ];

        try {
            $respuesta['conekta'] = Order::create($orden);
        } catch (Exception $e) {
            $respuesta = [
                'error' => true,
                'error_mensaje' => $e->getMessage()
            ];
        }

        return $respuesta;
    }

    public function msi($orden, $mensualidades, $tokenTarjeta)
    {
        return $this->aMesesSinIntereses($orden, $mensualidades, $tokenTarjeta);
    }

}