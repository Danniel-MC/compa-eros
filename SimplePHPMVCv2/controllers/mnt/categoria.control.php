<?php 

require_once "models/mnt/categorias.model.php";
function run() {
    $viewData=array();
    $viewData["mode"] = "";
    $viewData["modedsc"] = "";
    $viewData["catecod"] = 0;
    $viewData["catenom"] = "" ;
    $viewData["cateest"] = "ACT";
    $viewData["cateest_ACT"] = "selected";
    $viewData["cateest_INA"] = "";
    $viewData["cateest_EST"] = "";
    $viewData["readonly"] = "";

    $modedsc = array(
        "INS"=>"Nueva Categoria",
        "UPD"=>"Actualizar Categoria %s",
        "DSP"=>"Detalle de Categoria %s"
    );
    if (isset($_GET["mode"])) {
        $viewData["mode"] = $_GET["mode"];
        $viewData["catecod"] = intval($_GET["catecod"]);
        if (!isset($modedsc[$viewData["mode"]])) {
            redirectWithMessage("No se puede realizar esta operación.", "index.php?page=categorias");
            die();
        }
    }

    if (isset($_POST["btnsubmit"])) {
        mergeFullArrayTo($_POST, $viewData);
        //Verificacion de XSS_Token
        if (!(isset($_SESSION["cln_csstoken"]) && $_SESSION["cln_csstoken"] == $viewData["xsstoken"])) {
            redirectWithMessage("No se puede realizar esta operación.", "index.php?page=categorias");
            die();
        }
        switch ($viewData["mode"]){
        case "INS":
            $result = addNewcategoria(
                $viewData["catenom"],
                $viewData["cateest"]
            );
            if ($result > 0) {
                redirectWithMessage("Guardado Exitosamente", "index.php?page=categorias");
                die();
            }
            break;
        case "UPD":
            $result = updateCategoria(
                $viewData["catenom"],
                $viewData["cateest"],
                $viewData["catecod"]
            );
            if ($result >= 0) {
                redirectWithMessage("Se actualizo exitosamente", "index.php?page=categorias");
                die();
            }
            break;
        
        }
    }
    if ($viewData["mode"] === "INS") {
        $viewData["modedsc"] = $modedsc[$viewData["mode"]];
    } else {
        $categoriaDBData = getcategoriaById($viewData["catecod"]);
        mergeFullArrayTo($categoriaDBData, $viewData);
        $viewData["modedsc"] = sprintf($modedsc[$viewData["mode"]], $viewData["catenom"]);
        $viewData["cateest_ACT"] = ($viewData["cateest"]=="ACT")?"selected":"";
        $viewData["cateest_INA"] = ($viewData["cateest"]=="INA")?"selected":"";
        $viewData["cateest_EST"] = ($viewData["cateest"]=="EST")?"selected":"";
        // Sacar la data de la DB
        if ($viewData["mode"] != 'UPD') {
            $viewData["readonly"] = "readonly";
        }
        

    } 
    // token unico para su verificación posterior
    $viewData["xsstoken"] = uniqid("cln", true);
    $_SESSION["cln_csstoken"] = $viewData["xsstoken"];
    renderizar("mnt/categoria", $viewData);
}

run();
?>