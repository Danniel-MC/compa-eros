<h1>{{modedsc}}</h1>

<section>
<form method="post" action="index.php?page=comunicacion&mode={{mode}}&cmnid={{cmnid}}">
    <input type="hidden" name="mode" value="{{mode}}" />
    <input type="hidden" name="cmnid" value="{{cmnid}}" />
    <input type="hidden" name="xsstoken" value="{{xsstoken}}" />
    <div>
        <label for="catenom">Notas</label>
        <input {{readonly}} type="text" name="cmnNotas" id="cmnNotas" value="{{cmnNotas}}" placeholder="Escriba algun comentario" />
    </div>
    <div>
        <label for="cmntags">comunicaciones tags</label>
        <input {{readonly}} type="text" name="cmntags" id="cmntags" value="{{cmntags}}" placeholder="TAGS" />
    </div>
    <div>
        <label for="cmnusing">comunicaciones using</label>
        <input {{readonly}} type="text" name="cmnusing" id="cmnusing" value="{{cmnusing}}" placeholder="cmnusing" />
    </div>
    <div>
        <label for="cmntipo">comunicaciones tipo</label>
        <input {{readonly}} type="text" name="cmntipo" id="cmntipo" value="{{cmntipo}}" placeholder="cmntipo" />
    </div>
    <button id="btnsubmit" name="btnsubmit" type="submit">Enviar</button>
    <button id="btncancel">Cancelar</button>
</form>
</section>
<script>
    $().ready(function(){
        $("#btncancel").click(function(e){
            e.preventDefault();
            e.stopPropagation();
            location.assign("index.php?page=comunicaciones");
        });

    });
</script>