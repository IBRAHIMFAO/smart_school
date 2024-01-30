@extends("dashboard.master")

@section("content")
<div class="container-fluid" style="color: #0664c2;">
    <div class="row">
        <div class="col-12 col-sm-6 col-md-6 col-xxl-6">
            <h3 class="text-dark mb-4"
                style="font-size: 45px;font-weight: bold;font-style: italic;font-family: Acme, sans-serif;text-shadow: 1px 2px var(--bs-secondary-border-subtle);text-align: center;display: block;background: linear-gradient(#6cc2d5, white);padding: 7px;margin: 7px -15px;">
                &nbsp; Séances</h3>
        </div>
        <div class="col-12 col-sm-6 col-md-6 col-xxl-6">
            <h3 class="text-dark mb-4"
                style="font-size: 45px;font-weight: bold;font-style: italic;font-family: Acme, sans-serif;text-shadow: 1px 2px var(--bs-secondary-border-subtle);text-align: center;display: block;background: linear-gradient(#6cc2d5, white);">
            </h3>
            <h3 class="text-dark mb-4"
                style="font-size: 45px;font-weight: bold;font-style: italic;font-family: Acme, sans-serif;text-shadow: 1px 2px var(--bs-secondary-border-subtle);text-align: center;display: block;background: linear-gradient(#6cc2d5, white);padding: 7px;margin: -17px -15px;">
                &nbsp;&nbsp; L'année scolaire : 2022/2023</h3>
            <h3 class="text-dark mb-4"
                style="font-size: 45px;font-weight: bold;font-style: italic;font-family: Acme, sans-serif;text-shadow: 1px 2px var(--bs-secondary-border-subtle);text-align: center;display: block;background: linear-gradient(#6cc2d5, white);padding: -5px;margin: 7px -15px;">
            </h3>
        </div>
    </div>
    <div class="row">
        <div class="col-12 col-xxl-12" style="margin-bottom: 20px;">
            <div class="card"></div>
        </div>
        <div class="col">
            <div class="align-items-center form-row">
                <div class="col-sm form-group mb-3"
                    style="margin: 8px;width: 500.1px;height: 54px;padding: 0px;"><input type="text"
                        class="form-control ps-4 pe-4 rounded-pill" name="search"
                        placeholder="Search..."
                        style="height: 56px;width: 611.1px;margin: -17px 261px 0px;"></div>
                <div class="col-sm-auto text-end form-group mb-3" style="margin: 0px 124px 4px;"><button
                        class="btn btn-primary ps-4 pe-4 rounded-pill" type="submit"
                        style="width: 109.9px;height: 49px;"><i class="fa fa-search"
                            style="font-size: 29px;"></i></button></div>
            </div>
        </div>
    </div><!-- Start: TableSorter -->
    {{-- <div class="card" id="TableSorterCard-1">
        <div class="card-header py-3">
            <div class="row table-topper align-items-center" style="color: rgb(16,16,17);">
                <div class="col-xxl-6">
                    <div class="btn-group"
                        style="margin: 3px;width: 227.8px;height: 76px;font-size: 33px;"><button
                            class="btn btn-primary" type="button" style="font-weight: bold;">L'emploi du
                            temps </button><button
                            class="btn btn-primary dropdown-toggle dropdown-toggle-split"
                            data-bs-toggle="dropdown" aria-expanded="false" type="button"></button>
                        <div class="dropdown-menu"><a class="dropdown-item" href="#">First Item</a><a
                                class="dropdown-item" href="#">Second Item</a><a class="dropdown-item"
                                href="#">Third Item</a></div>
                    </div>
                </div>
                <div class="col-12 col-sm-7 col-md-6 text-end" style="margin: 0px;padding: 5px 15px;"><a
                        class="btn btn-primary" role="button"
                        style="color: rgb(255,255,255);font-style: italic;border-width: 8px;font-size: 23px;margin: -1px 39px 22px;padding: 8px 16px;font-weight: bold;line-height: 22.5px;"><i
                            class="fa fa-plus" style="color: var(--bs-btn-color);"></i>&nbsp;
                        &nbsp;ajouter</a></div>
            </div>
        </div>
        <div class="row">
            <div class="col-12">
                <div class="table-responsive">
                    <table class="table table-striped table tablesorter" id="ipi-table">
                        <thead class="thead-dark" style="color: #858796;background: #0664c2;">
                            <tr>
                                <th class="text-center"
                                    style="background: #1f91aa;font-weight: bold;font-style: italic;">
                                    Groupes</th>
                                <th class="text-center"
                                    style="background: #0664c2;font-weight: bold;font-style: italic;">
                                    Matière</th>
                                <th class="text-center"
                                    style="background: #1f91aa;font-weight: bold;font-style: italic;">
                                    prof</th>
                                <th class="text-center"
                                    style="background: #0664c2;font-weight: bold;font-style: italic;">
                                    salle</th>
                                <th class="text-center"
                                    style="background: #1f91aa;font-weight: bold;font-style: italic;">
                                    date</th>
                                <th class="text-center"
                                    style="background: #0664c2;font-weight: bold;font-style: italic;">
                                    début_séance</th>
                                <th class="text-center"
                                    style="background: #1f91aa;font-weight: bold;font-style: italic;">
                                    fin_séance</th>
                                <th class="text-center"
                                    style="background: #0664c2;font-weight: bold;font-style: italic;">
                                    create</th>
                                <th class="text-center"
                                    style="background: #1f91aa;font-weight: bold;font-style: italic;">
                                    update</th>
                                <th class="text-center filter-false sorter-false"
                                    style="background: #0664c2;font-style: italic;font-weight: bold;">
                                    action</th>
                            </tr>
                        </thead>
                        <tbody class="text-center">
                            <tr>
                                <td>Ana</td>
                                <td>jjjj<p data-bs-toggle="tooltip" data-bss-tooltip=""
                                        title="Ya descargado"></p>
                                    <p data-bs-toggle="tooltip" data-bss-tooltip=""
                                        title="No ha sido atendido"></p>
                                    <p data-bs-toggle="tooltip" data-bss-tooltip=""
                                        title="Requiere validación"></p>
                                </td>
                                <td>Diseñador</td>
                                <td>Diseñador</td>
                                <td>Diseño</td>
                                <td>Diseño</td>
                                <td>Diseño</td>
                                <td>Diseño</td>
                                <td>Diseño</td>
                                <td class="text-center align-middle"
                                    style="max-height: 60px;height: 60px;"><a
                                        class="btn btn-dark btnMaterial btn-flat primary semicircle"
                                        role="button" data-bs-toggle="tooltip" data-bss-tooltip=""
                                        href="attach-document.html" title="Adjuntar archivo"><i
                                            class="fas fa-paperclip text-warning"></i></a><a
                                        class="btn btnMaterial btn-flat primary semicircle"
                                        role="button" data-bs-toggle="tooltip" data-bss-tooltip=""
                                        href="show.html" title="Ver detalles"><i
                                            class="far fa-eye"></i></a><a
                                        class="btn btnMaterial btn-flat success semicircle"
                                        role="button" data-bs-toggle="tooltip" data-bss-tooltip=""
                                        href="finish-document.html" title="Descargar"><i
                                            class="fas fa-check text-info"
                                            style="color: rgb(59,87,231);"></i></a><a
                                        class="btn btnMaterial btn-flat success semicircle"
                                        role="button" data-bs-toggle="tooltip" data-bss-tooltip=""
                                        href="send-document.html" title="Turnar"><i
                                            class="fas fa-arrows-alt"></i></a><a
                                        class="btn btnMaterial btn-flat success semicircle"
                                        role="button" data-bs-toggle="tooltip" data-bss-tooltip=""
                                        href="create-document.html" title="Turnar"><i
                                            class="fas fa-pen"></i></a><a
                                        class="btn btnMaterial btn-flat accent btnNoBorders checkboxHover"
                                        role="button" data-bs-toggle="modal" data-bss-tooltip=""
                                        style="margin-left: 5px;" data-bs-target="#delete-modal"
                                        href="#" title="Eliminar"><i class="fas fa-trash btnNoBorders"
                                            style="color: #DC3545;font-size: 17px;"></i></a><a
                                        class="btn btnMaterial btn-flat accent btnNoBorders checkboxHover"
                                        role="button" data-bs-toggle="modal" data-bss-tooltip=""
                                        style="margin-left: 5px;" data-bs-target="#delete-modal"
                                        href="#" title="Eliminar"></a></td>
                            </tr>
                            <tr>
                                <td>Fer<br></td>
                                <td>
                                    <p data-bs-toggle="tooltip" data-bss-tooltip=""
                                        title="No ha sido atendido">jjjjjjjjjjjjjjjj</p>
                                </td>
                                <td>Desarrollador</td>
                                <td>Development</td>
                                <td>Development</td>
                                <td>Development</td>
                                <td>Development</td>
                                <td>Development</td>
                                <td>Development</td>
                            </tr>
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div><!-- End: TableSorter -->
</div><!-- End: Ludens - Index v2 with Backend & Frontend Filters --> --}}
    {{-- <!-- Start: Pagination_01 -->
<div class="pages"><a href="#" class="back disabled"><span class="fa fa-arrow-circle-left">back</a>
        <a href="#" class="page active">1</a><a href="#" class="page">2</a><a href="#"
        class="page">3</a><a href="#" class="next">forward <span
            class="fa fa-arrow-circle-right"></span></a><i class="far fa-star"></i></div>
<!-- End: Pagination_01 --> --}}


<!-- Start: Billing Table with Add Row & Fixed Header Feature -->


<div class="card" id="TableSorterCard-1">
    <div class="card-header py-3">
        <div class="row table-topper align-items-center" style="color: rgb(16,16,17);">
            <div class="col-xxl-6">
                <div class="btn-group"
                    style="margin: 3px;width: 227.8px;height: 76px;font-size: 33px;">
                    <button class="btn btn-primary" type="button" style="font-weight: bold;">
                        L'emploi du temps
                    </button>
                    <button class="btn btn-primary dropdown-toggle dropdown-toggle-split"
                        data-bs-toggle="dropdown" aria-expanded="false" type="button"></button>
                    <div class="dropdown-menu">
                        <a class="dropdown-item" href="#">First Item</a>
                        <a class="dropdown-item" href="#">Second Item</a>
                        <a class="dropdown-item" href="#">Third Item</a>
                    </div>
                </div>
            </div>
            <div class="col-12 col-sm-7 col-md-6 text-end" style="margin: 0px;padding: 5px 15px;">

                <a href="{{ route('dash-seance.create') }}"  class="btn btn-primary" role="button"
                    style="color: rgb(255,255,255);font-style: italic;border-width: 8px;font-size: 23px;margin: -1px 39px 22px;padding: 8px 16px;font-weight: bold;line-height: 22.5px;">
                    <i class="fa fa-plus" style="color: var(--bs-btn-color);"></i>&nbsp;&nbsp;Add Seance

                </a>
            </div>
        </div>
    </div>
    <div class="row">
        <div class="col-12">
            <div class="table-responsive">
                <table class="table table-striped tablesorter" id="ipi-table">
                    <thead class="thead-dark" style="color: #858796;background: #0664c2;">
                        <tr>
                            <th class="text-center"
                                style="background: #1f91aa;font-weight: bold;font-style: italic;">
                                Groupes
                            </th>
                            <th class="text-center"
                                style="background: #0664c2;font-weight: bold;font-style: italic;">
                                Matière
                            </th>
                            <th class="text-center"
                                style="background: #1f91aa;font-weight: bold;font-style: italic;">
                                prof
                            </th>
                            <th class="text-center"
                                style="background: #0664c2;font-weight: bold;font-style: italic;">
                                salle
                            </th>
                            <th class="text-center"
                                style="background: #1f91aa;font-weight: bold;font-style: italic;">
                                date
                            </th>
                            <th class="text-center"
                                style="background: #0664c2;font-weight: bold;font-style: italic;">
                                début_séance
                            </th>
                            <th class="text-center"
                                style="background: #1f91aa;font-weight: bold;font-style: italic;">
                                fin_séance
                            </th>
                            <th class="text-center"
                                style="background: #0664c2;font-weight: bold;font-style: italic;">
                                create
                            </th>
                            <th class="text-center"
                                style="background: #1f91aa;font-weight: bold;font-style: italic;">
                                update
                            </th>
                            <th class="text-center filter-false sorter-false"
                                style="background: #0664c2;font-style: italic;font-weight: bold;">
                                action
                            </th>
                        </tr>
                    </thead>
                    <tbody class="text-center">
                        @if (!empty($seances))
                            @php $i = 1; @endphp
                            @foreach ($seances as $seance)
                                <tr>
                                    <td>{{ $seance->group->nom_group }}</td>
                                    <td>{{ $seance->matiere->nom_matiere }}</td>
                                    <td>{{ $seance->prof->firstName }} {{ $seance->prof->lastName }}</td>
                                    <td>{{ $seance->salle->status }} N:{{ $seance->salle->numero_salle }}</td>
                                    <td>{{ $seance->date }}</td>
                                    <td>{{ $seance->heure_debut }}</td>
                                    <td>{{ $seance->heure_fin }}</td>
                                    <td>{{ $seance->created_at }}</td>
                                    <td>{{ $seance->updated_at }}</td>
                                    <td class="text-center align-middle">
                                        <a href="#" class="btn btn-dark btnMaterial btn-flat primary semicircle"
                                            role="button" data-bs-toggle="tooltip" data-bss-tooltip=""
                                            title="Adjuntar archivo">
                                            <i class="fas fa-paperclip text-warning"></i>
                                        </a>
                                        <a href="#" class="btn btnMaterial btn-flat primary semicircle"
                                            role="button" data-bs-toggle="tooltip" data-bss-tooltip=""
                                            title="Ver detalles">
                                            <i class="far fa-eye"></i>
                                        </a>
                                        <a href="#" class="btn btnMaterial btn-flat success semicircle"
                                            role="button" data-bs-toggle="tooltip" data-bss-tooltip=""
                                            title="Descargar">
                                            <i class="fas fa-check text-info"
                                                style="color: rgb(59,87,231);"></i>
                                        </a>
                                        <a href="#" class="btn btnMaterial btn-flat success semicircle"
                                            role="button" data-bs-toggle="tooltip" data-bss-tooltip=""
                                            title="Turnar">
                                            <i class="fas fa-arrows-alt"></i>
                                        </a>
                                        <a href="#" class="btn btnMaterial btn-flat success semicircle"
                                            role="button" data-bs-toggle="tooltip" data-bss-tooltip=""
                                            title="Turnar">

                                        </a>

                                        <a href="{{ route('dash-seance.edit', $seance->id) }}" class="btn btn-primary" style="margin:2%"><i class="fas fa-pen">
                                            </i> Edit</a>

                                            <form action="{{ route('dash-seance.destroy', $seance->id) }}" method="POST" style="display: inline">
                                                @csrf
                                                @method('DELETE')
                                                <button type="submit" class="btn btn-danger" style="margin:2%">
                                                     <i class="fas fa-trash btnNoBorders"
                                                    style="color: #efe4e5;font-size: 17px;"></i>
                                                    Delete
                                            </button>

                                            </a>
                                            </form>

                                    </td>
                                </tr>
                                @php $i++; @endphp
                            @endforeach
                        @endif
                    </tbody>
                </table>
            </div>
        </div>
    </div>
</div>

 {{-- @include("elements.pagination") --}}
 @include('elements.pagination', ['seances' => $seances])



@endsection


