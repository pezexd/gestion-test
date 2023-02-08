<!doctype html>
<html>

<head>
    <script>
        function subst() {
            var vars = {};
            var query_strings_from_url = document.location.search.substring(1).split('&');
            for (var query_string in query_strings_from_url) {
                if (query_strings_from_url.hasOwnProperty(query_string)) {
                    var temp_var = query_strings_from_url[query_string].split('=', 2);
                    vars[temp_var[0]] = decodeURI(temp_var[1]);
                }
            }
            var css_selector_classes = ['page', 'frompage', 'topage', 'webpage', 'section', 'subsection', 'date', 'isodate', 'time', 'title', 'doctitle', 'sitepage', 'sitepages'];
            for (var css_class in css_selector_classes) {
                if (css_selector_classes.hasOwnProperty(css_class)) {
                    var element = document.getElementsByClassName(css_selector_classes[css_class]);
                    for (var j = 0; j < element.length; ++j) {
                        element[j].textContent = vars[css_selector_classes[css_class]];
                    }
                }
            }
        }
    </script>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <meta name="robots" content="noindex,nofollow" />
    <meta name="viewport" content="width=device-width; initial-scale=1.0;" />
    <style type="text/css">
        body {
            font-family: Verdana;
            margin-top: 150px;
        }

        .even {
            background: #fbf8f0;
        }

        .odd {
            background: #fefcf9;
        }

        .page
        {
            page-break-after: always;
            page-break-inside: avoid;
        }

        .ocultarcolumnas{
            visibility:hidden;
        }

        table , td, th {
            border: 1px solid #595959;
            border-collapse: collapse;
        }
        td, th {
            padding: 3px;
            width: 30px;
            height: 25px;
        }
        th {
            background: #f0e6cc;
        }
        .even {
            background: #fbf8f0;
        }
        .odd {
            background: #fefcf9;
        }
        p{
            font-size:15px;
        }
    </style>
</head>

<body onload="subst()">
    <div class="">
        <tr>
            <table width="100%" style="">
                <thead>
                    <tr>
                        <td class="ocultarcolumnas" style="width: 2%">1</td>
                        <td class="ocultarcolumnas" style="width: 2%">2</td>
                        <td class="ocultarcolumnas" style="width: 2%">3</td>
                        <td class="ocultarcolumnas" style="width: 2%">4</td>
                        <td class="ocultarcolumnas" style="width: 2%">5</td>
                        <td class="ocultarcolumnas" style="width: 2%">6</td>
                        <td class="ocultarcolumnas" style="width: 2%">7</td>
                        <td class="ocultarcolumnas" style="width: 2%">8</td>
                        <td class="ocultarcolumnas" style="width: 2%">9</td>
                        <td class="ocultarcolumnas" style="width: 2%">10</td>
                        <td class="ocultarcolumnas" style="width: 2%">11</td>
                        <td class="ocultarcolumnas" style="width: 2%">12</td>
                        <td class="ocultarcolumnas" style="width: 2%">13</td>
                        <td class="ocultarcolumnas" style="width: 2%">14</td>
                        <td class="ocultarcolumnas" style="width: 2%">15</td>
                        <td class="ocultarcolumnas" style="width: 2%">16</td>
                        <td class="ocultarcolumnas" style="width: 2%">17</td>
                        <td class="ocultarcolumnas" style="width: 2%">18</td>
                        <td class="ocultarcolumnas" style="width: 2%">19</td>
                        <td class="ocultarcolumnas" style="width: 2%">20</td>
                        <td class="ocultarcolumnas" style="width: 2%">21</td>
                        <td class="ocultarcolumnas" style="width: 2%">22</td>
                        <td class="ocultarcolumnas" style="width: 2%">23</td>
                        <td class="ocultarcolumnas" style="width: 2%">24</td>
                        <td class="ocultarcolumnas" style="width: 2%">25</td>
                        <td class="ocultarcolumnas" style="width: 2%">26</td>
                        <td class="ocultarcolumnas" style="width: 2%">27</td>
                        <td class="ocultarcolumnas" style="width: 2%">28</td>
                        <td class="ocultarcolumnas" style="width: 2%">29</td>
                        <td class="ocultarcolumnas" style="width: 2%">30</td>
                        <td class="ocultarcolumnas" style="width: 2%">31</td>
                        <td class="ocultarcolumnas" style="width: 2%">32</td>
                        <td class="ocultarcolumnas" style="width: 2%">33</td>
                        <td class="ocultarcolumnas" style="width: 2%">34</td>
                    </tr>
                </thead>
                <tbody>
                    <tr>
                        <td colspan="13" rowspan="4">
                            <div>
                                <img style="width:100%;height: 125px;" src="data:image/svg+xml;base64,{{$imagen}}">
                                {{-- <img style="width:100%;height: 125px;" src="data:image/png;base64,{{ base64_encode(file_get_contents(public_path().'/img/imagen.png'))}}"> --}}
                            </div>
                        </td>
                        <td colspan="14" rowspan="4" style="font-size:12px;text-align:justify">
                            <b>COVENIO INTERADMINISTRATIVO 1240.20.2-3310</b><br>
                            Aunar esfuerzos técnicos, operativos y financieros para promover el accesso a
                            los bines y servicios artisticos y culturales de los vallecaucanos a través de la
                            implementacion de una red de monitores culturales en atención al proyecto
                            denominado: "PROTECCIÓN y PROMOCIÓN DE LOS DERECHOS CULTURALES".
                            <h3 style="text-align: center">RED DE MONITORES Culturales</h3>
                        </td>
                        <td colspan="7">
                            <p style="text-align: left;margin-top: -1%;margin-bottom:0%"><b>Código:</b> {{ $datos['Codigo'] }}</p>
                        </td>
                    </tr>
                    <tr>
                        <td colspan="7">
                            <p style="text-align: left;margin-top: -1%;margin-bottom:0%"><b>Versión:</b> {{ $datos['Version'] }}</p>
                        </td>
                    </tr>
                    <tr>
                        <td colspan="7">
                            <p style="text-align: left;margin-top: -1%;"><b>Fecha de aprobación:</b></p>
                            <p style="text-align: left;margin-top: -10%;margin-bottom:0%">{{ $datos['Fecha'] }}</p>
                        </td>
                    </tr>
                    <tr>
                        <td colspan="7">
                            <p style="text-align: left;margin-top: -1%;margin-bottom:0%"><b>Página </b><span class="page"></span> de <span class="topage"></span></p>
                        </td>
                    </tr>
                    <tr>
                        <td colspan="34" style="background: #164E63">
                            <h3 style="text-align: center; color:#ffffff;">FORMATO DE ESCUELA DE PADRES</h3>
                        </td>
                    </tr>
                </tbody>
            </table>
        </tr>
    </div>
</body>

</html>
