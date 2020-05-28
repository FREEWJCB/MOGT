@if (session("mensaje"))
<div class="alert alert-info alert-dismissible">
    <button type="button" class="close" data-dismiss="alert" aria-hidden="true">×</button>
    <h4><i class="icon fa fa-check"></i>Mensaje sistema INSAS.</h4>
    <ul>
        <li>{{ session("mensaje") }}</li>
    </ul>
</div>
@endif