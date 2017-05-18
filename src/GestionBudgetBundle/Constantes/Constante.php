<?php
namespace GestionBudgetBundle\Constantes;
/**
 * Created by PhpStorm.
 * User: Ibrahima
 * Date: 11/05/2017
 * Time: 18:47
 */
class Constante
{

    const COMMUNE = "commune";
    const DEPARTEMENT = "departement";
    const COLOR = array(
        array(
            "minvalue"  => 0,
            "maxvalue" => 15000000,
            "code" => "f8bd19",
            "displayvalue" => "< 20M"
        ),
        array(
            "minvalue" => "20000000",
            "maxvalue" => 50000000,
            "code" => "6baa01",
            "displayvalue" => "20-50M"
        ),
        array(
            "minvalue" => "50000000",
            "maxvalue" => 100000000,
            "code" => "eed698",
            "displayvalue" => "50-100M"
        ),
        array(
            "minvalue" => "100000000",
            "maxvalue" => 200000000,
            "code" => "fa0808",
            "displayvalue" => "100-200M"
        )
    );
    const CHARTCARTE = array(
        "caption" => "La gestion des budgets du Sénagal",
        "theme" => "fint",
        "formatNumberScale" => "0",
        "showLabels" => "1",
        "hoverOnNull" => "0",
        "rotateValues" => "1",
        "exportEnabled" => "1"
    );

    public static function ChartParameters($axe, $portee) {

        $chart = array(
            "caption" => "La répartition des $axe  sur  $portee",
            "yaxisname" => "Valeur du budget",
            "showvalues" => "0",
            "bgcolor" => "FFFFFF",
            "xaxisname" => "$portee",
            "plotgradientcolor" => "",
            "showalternatehgridcolor" => "0",
            "showplotborder" => "0",
            "divlinecolor" => "CCCCCC",
            "canvasborderalpha" => "0",
            "rotateValues" => "1",
            "exportEnabled" => "1"
        );

        return $chart;
    }

}