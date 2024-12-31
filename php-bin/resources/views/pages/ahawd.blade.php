@extends('layout')
@section('subtitle'){{ trans('esdr2.glossary_heading') }}@endsection

@section('content')

<div class="blue-bg directory-masthead childcare" style="padding-top:0.7em; padding-bottom:0em">
        <div class="restrain">
                <img src="/img/indigenous-hex.png" alt="" class="key-image thirds">
                <h2 id="directory-main-heading" class="ministry-blue slide-title">Aboriginal Students: How Are We Doing
                        2023/2024</h2>
                <h4 style="color:white">The Aboriginal: How Are We Doing Report is an annual, public-facing report focusing on
                        Indigenous students in B.C. The data in this report provides teachers, schools, school districts and the
                        Ministry of Education and Child Care with important information on how Indigenous students are developing
                        and identifies areas for interventions or further action.</h4><br><br>
                <br>
        </div>
</div>

<section class="container ahawd-table">
        <table class="table table-striped" style="width:50% !important; margin-left: 58px; font-size: 1.5rem;">
                <thead>
                        <tr>
                                <th scope="col">District</th>
                                <th scope="col"></th>
                                <th scope="col"></th>
                        </tr>
                </thead>
                <tbody>
                        <tr>
                                <th scope="row">All Districts</th>
                                <td><a href="https://www.bcedextranet.gov.bc.ca/student-success/reports/abhawd-all-school-district-pdf.zip"
                                                target="_blank">(67.4 MB, ZIP | PDF)</a></td>
                                <td><a href="https://www.bcedextranet.gov.bc.ca/student-success/reports/xlsx-ab-hawd-school-district.zip"
                                                target="_blank">(128 MB, ZIP |Excel)</a></td>
                        </tr>
                        <tr>
                                <th scope="row">B.C. Public Schools (99)</th>
                                <td><a href="https://www2.gov.bc.ca/assets/gov/education/administration/kindergarten-to-grade-12/reports/ab-hawd/ab-hawd-school-district-public.pdf"
                                                target="_blank">PDF</a></td>
                                <td><a href="https://www2.gov.bc.ca/assets/download/CFC6AF49B7B04849B6164FF022A157D4"
                                                target="_blank">Excel</a></td>
                        </tr>
                        <tr>
                                <th scope="row">Abbotsford (34)</th>
                                <td><a href="https://www2.gov.bc.ca/assets/gov/education/administration/kindergarten-to-grade-12/reports/ab-hawd/ab-hawd-school-district-034.pdf"
                                                target="_blank">PDF</a></td>
                                <td><a href="https://www2.gov.bc.ca/assets/gov/education/administration/kindergarten-to-grade-12/reports/ab-hawd/ab-hawd-school-district-034.xlsx"
                                                target="_blank">Excel</a></td>
                        </tr>
                        <tr>
                                <th scope="row">Arrow Lakes (10)</th>
                                <td><a href="https://www2.gov.bc.ca/assets/gov/education/administration/kindergarten-to-grade-12/reports/ab-hawd/ab-hawd-school-district-010.pdf"
                                                target="_blank">PDF</a></td>
                                <td><a href="https://www2.gov.bc.ca/assets/gov/education/administration/kindergarten-to-grade-12/reports/ab-hawd/ab-hawd-school-district-010.xlsx"
                                                target="_blank">Excel</a></td>
                        </tr>
                        <tr>
                                <th scope="row">Boundary (51)</th>
                                <td><a href="https://www2.gov.bc.ca/assets/gov/education/administration/kindergarten-to-grade-12/reports/ab-hawd/ab-hawd-school-district-051.pdf"
                                                target="_blank">PDF</a></td>
                                <td><a href="https://www2.gov.bc.ca/assets/gov/education/administration/kindergarten-to-grade-12/reports/ab-hawd/ab-hawd-school-district-051.xlsx"
                                                target="_blank">Excel</a></td>
                        </tr>
                        <tr>
                                <th scope="row">Bulkley Valley (54)</th>
                                <td><a href="https://www2.gov.bc.ca/assets/gov/education/administration/kindergarten-to-grade-12/reports/ab-hawd/ab-hawd-school-district-054.pdf"
                                                target="_blank">PDF</a></td>
                                <td><a href="https://www2.gov.bc.ca/assets/gov/education/administration/kindergarten-to-grade-12/reports/ab-hawd/ab-hawd-school-district-054.xlsx"
                                                target="_blank">Excel</a></td>
                        </tr>
                        <tr>
                                <th scope="row">Burnaby (41)</th>
                                <td><a href="https://www2.gov.bc.ca/assets/gov/education/administration/kindergarten-to-grade-12/reports/ab-hawd/ab-hawd-school-district-041.pdf"
                                                target="_blank">PDF</a></td>
                                <td><a href="https://www2.gov.bc.ca/assets/gov/education/administration/kindergarten-to-grade-12/reports/ab-hawd/ab-hawd-school-district-041.xlsx"
                                                target="_blank">Excel</a></td>
                        </tr>
                        <tr>
                                <th scope="row">Campbell River (72)</th>
                                <td><a href="https://www2.gov.bc.ca/assets/gov/education/administration/kindergarten-to-grade-12/reports/ab-hawd/ab-hawd-school-district-072.pdf"
                                                target="_blank">PDF</a></td>
                                <td><a href="https://www2.gov.bc.ca/assets/gov/education/administration/kindergarten-to-grade-12/reports/ab-hawd/ab-hawd-school-district-072.xlsx"
                                                target="_blank">Excel</a></td>
                        </tr>
                        <tr>
                                <th scope="row">Cariboo-Chilcotin (27)</th>
                                <td><a href="https://www2.gov.bc.ca/assets/gov/education/administration/kindergarten-to-grade-12/reports/ab-hawd/ab-hawd-school-district-027.pdf"
                                                target="_blank">PDF</a></td>
                                <td><a href="https://www2.gov.bc.ca/assets/gov/education/administration/kindergarten-to-grade-12/reports/ab-hawd/ab-hawd-school-district-027.xlsx"
                                                target="_blank">Excel</a></td>
                        </tr>
                        <tr>
                                <th scope="row">Central Coast (49)</th>
                                <td><a href="https://www2.gov.bc.ca/assets/gov/education/administration/kindergarten-to-grade-12/reports/ab-hawd/ab-hawd-school-district-049.pdf"
                                                target="_blank">PDF</a></td>
                                <td><a href="https://www2.gov.bc.ca/assets/gov/education/administration/kindergarten-to-grade-12/reports/ab-hawd/ab-hawd-school-district-049.xlsx"
                                                target="_blank">Excel</a></td>
                        </tr>
                        <tr>
                                <th scope="row">Central Okanagan (23)</th>
                                <td><a href="https://www2.gov.bc.ca/assets/gov/education/administration/kindergarten-to-grade-12/reports/ab-hawd/ab-hawd-school-district-023.pdf"
                                                target="_blank">PDF</a></td>
                                <td><a href="https://www2.gov.bc.ca/assets/gov/education/administration/kindergarten-to-grade-12/reports/ab-hawd/ab-hawd-school-district-023.xlsx"
                                                target="_blank">Excel</a></td>
                        </tr>
                        <tr>
                                <th scope="row">Chilliwack (33)</th>
                                <td><a href="https://www2.gov.bc.ca/assets/gov/education/administration/kindergarten-to-grade-12/reports/ab-hawd/ab-hawd-school-district-033.pdf"
                                                target="_blank">PDF</a></td>
                                <td><a href="https://www2.gov.bc.ca/assets/gov/education/administration/kindergarten-to-grade-12/reports/ab-hawd/ab-hawd-school-district-033.xlsx"
                                                target="_blank">Excel</a></td>
                        </tr>
                        <tr>
                                <th scope="row">Coast Mountains (82)</th>
                                <td><a href="https://www2.gov.bc.ca/assets/gov/education/administration/kindergarten-to-grade-12/reports/ab-hawd/ab-hawd-school-district-082.pdf"
                                                target="_blank">PDF</a></td>
                                <td><a href="https://www2.gov.bc.ca/assets/gov/education/administration/kindergarten-to-grade-12/reports/ab-hawd/ab-hawd-school-district-082.xlsx"
                                                target="_blank">Excel</a></td>
                        </tr>
                        <tr>
                                <th scope="row">Comox Valley (71)</th>
                                <td><a href="https://www2.gov.bc.ca/assets/gov/education/administration/kindergarten-to-grade-12/reports/ab-hawd/ab-hawd-school-district-071.pdf"
                                                target="_blank">PDF</a></td>
                                <td><a href="https://www2.gov.bc.ca/assets/gov/education/administration/kindergarten-to-grade-12/reports/ab-hawd/ab-hawd-school-district-071.xlsx"
                                                target="_blank">Excel</a></td>
                        </tr>
                        <tr>
                                <th scope="row">Conseil scolaire francophone (93)</th>
                                <td><a href="https://www2.gov.bc.ca/assets/gov/education/administration/kindergarten-to-grade-12/reports/ab-hawd/ab-hawd-school-district-093.pdf"
                                                target="_blank">PDF</a></td>
                                <td><a href="https://www2.gov.bc.ca/assets/gov/education/administration/kindergarten-to-grade-12/reports/ab-hawd/ab-hawd-school-district-093.xlsx"
                                                target="_blank">Excel</a></td>
                        </tr>
                        <tr>
                                <th scope="row">Coquitlam (43)</th>
                                <td><a href="https://www2.gov.bc.ca/assets/gov/education/administration/kindergarten-to-grade-12/reports/ab-hawd/ab-hawd-school-district-043.pdf"
                                                target="_blank">PDF</a></td>
                                <td><a href="https://www2.gov.bc.ca/assets/gov/education/administration/kindergarten-to-grade-12/reports/ab-hawd/ab-hawd-school-district-043.xlsx"
                                                target="_blank">Excel</a></td>
                        </tr>
                        <tr>
                                <th scope="row">Cowichan Valley (79)</th>
                                <td><a href="https://www2.gov.bc.ca/assets/gov/education/administration/kindergarten-to-grade-12/reports/ab-hawd/ab-hawd-school-district-079.pdf"
                                                target="_blank">PDF</a></td>
                                <td><a href="https://www2.gov.bc.ca/assets/gov/education/administration/kindergarten-to-grade-12/reports/ab-hawd/ab-hawd-school-district-079.xlsx"
                                                target="_blank">Excel</a></td>
                        </tr>
                        <tr>
                                <th scope="row">Delta (37)</th>
                                <td><a href="https://www2.gov.bc.ca/assets/gov/education/administration/kindergarten-to-grade-12/reports/ab-hawd/ab-hawd-school-district-037.pdf"
                                                target="_blank">PDF</a></td>
                                <td><a href="https://www2.gov.bc.ca/assets/gov/education/administration/kindergarten-to-grade-12/reports/ab-hawd/ab-hawd-school-district-037.xlsx"
                                                target="_blank">Excel</a></td>
                        </tr>
                        <tr>
                                <th scope="row">Fort Nelson (81)</th>
                                <td><a href="https://www2.gov.bc.ca/assets/gov/education/administration/kindergarten-to-grade-12/reports/ab-hawd/ab-hawd-school-district-081.pdf"
                                                target="_blank">PDF</a></td>
                                <td><a href="https://www2.gov.bc.ca/assets/gov/education/administration/kindergarten-to-grade-12/reports/ab-hawd/ab-hawd-school-district-081.xlsx"
                                                target="_blank">Excel</a></td>
                        </tr>
                        <tr>
                                <th scope="row">Fraser Cascade (78)</th>
                                <td><a href="https://www2.gov.bc.ca/assets/gov/education/administration/kindergarten-to-grade-12/reports/ab-hawd/ab-hawd-school-district-078.pdf"
                                                target="_blank">PDF</a></td>
                                <td><a href="https://www2.gov.bc.ca/assets/gov/education/administration/kindergarten-to-grade-12/reports/ab-hawd/ab-hawd-school-district-078.xlsx"
                                                target="_blank">Excel</a></td>
                        </tr>
                        <tr>
                                <th scope="row">Gold Trail (74)</th>
                                <td><a href="https://www2.gov.bc.ca/assets/gov/education/administration/kindergarten-to-grade-12/reports/ab-hawd/ab-hawd-school-district-074.pdf"
                                                target="_blank">PDF</a></td>
                                <td><a href="https://www2.gov.bc.ca/assets/gov/education/administration/kindergarten-to-grade-12/reports/ab-hawd/ab-hawd-school-district-074.xlsx"
                                                target="_blank">Excel</a></td>
                        </tr>
                        <tr>
                                <th scope="row">Greater Victoria (61)</th>
                                <td><a href="https://www2.gov.bc.ca/assets/gov/education/administration/kindergarten-to-grade-12/reports/ab-hawd/ab-hawd-school-district-061.pdf"
                                                target="_blank">PDF</a></td>
                                <td><a href="https://www2.gov.bc.ca/assets/gov/education/administration/kindergarten-to-grade-12/reports/ab-hawd/ab-hawd-school-district-061.xlsx"
                                                target="_blank">Excel</a></td>
                        </tr>
                        <tr>
                                <th scope="row">Gulf Islands (64)</th>
                                <td><a href="https://www2.gov.bc.ca/assets/gov/education/administration/kindergarten-to-grade-12/reports/ab-hawd/ab-hawd-school-district-064.pdf"
                                                target="_blank">PDF</a></td>
                                <td><a href="https://www2.gov.bc.ca/assets/gov/education/administration/kindergarten-to-grade-12/reports/ab-hawd/ab-hawd-school-district-064.xlsx"
                                                target="_blank">Excel</a></td>
                        </tr>
                        <tr>
                                <th scope="row">Haida Gwaii (50)</th>
                                <td><a href="https://www2.gov.bc.ca/assets/gov/education/administration/kindergarten-to-grade-12/reports/ab-hawd/ab-hawd-school-district-050.pdf"
                                                target="_blank">PDF</a></td>
                                <td><a href="https://www2.gov.bc.ca/assets/gov/education/administration/kindergarten-to-grade-12/reports/ab-hawd/ab-hawd-school-district-050.xlsx"
                                                target="_blank">Excel</a></td>
                        </tr>
                        <tr>
                                <th scope="row">Kamloops-Thompson (73)</th>
                                <td><a href="https://www2.gov.bc.ca/assets/gov/education/administration/kindergarten-to-grade-12/reports/ab-hawd/ab-hawd-school-district-073.pdf"
                                                target="_blank">PDF</a></td>
                                <td><a href="https://www2.gov.bc.ca/assets/gov/education/administration/kindergarten-to-grade-12/reports/ab-hawd/ab-hawd-school-district-073.xlsx"
                                                target="_blank">Excel</a></td>
                        </tr>
                        <tr>
                                <th scope="row">Kootenay Lake (8)</th>
                                <td><a href="https://www2.gov.bc.ca/assets/gov/education/administration/kindergarten-to-grade-12/reports/ab-hawd/ab-hawd-school-district-008.pdf"
                                                target="_blank">PDF</a></td>
                                <td><a href="https://www2.gov.bc.ca/assets/gov/education/administration/kindergarten-to-grade-12/reports/ab-hawd/ab-hawd-school-district-008.xlsx"
                                                target="_blank">Excel</a></td>
                        </tr>
                        <tr>
                                <th scope="row">Kootenay Columbia (20)</th>
                                <td><a href="https://www2.gov.bc.ca/assets/gov/education/administration/kindergarten-to-grade-12/reports/ab-hawd/ab-hawd-school-district-020.pdf"
                                                target="_blank">PDF</a></td>
                                <td><a href="https://www2.gov.bc.ca/assets/gov/education/administration/kindergarten-to-grade-12/reports/ab-hawd/ab-hawd-school-district-020.xlsx"
                                                target="_blank">Excel</a></td>
                        </tr>
                        <tr>
                                <th scope="row">Langley (35)</th>
                                <td><a href="https://www2.gov.bc.ca/assets/gov/education/administration/kindergarten-to-grade-12/reports/ab-hawd/ab-hawd-school-district-035.pdf"
                                                target="_blank">PDF</a></td>
                                <td><a href="https://www2.gov.bc.ca/assets/gov/education/administration/kindergarten-to-grade-12/reports/ab-hawd/ab-hawd-school-district-035.xlsx"
                                                target="_blank">Excel</a></td>
                        </tr>
                        <tr>
                                <th scope="row">Maple Ridge-Pitt Meadows (42)</th>
                                <td><a href="https://www2.gov.bc.ca/assets/gov/education/administration/kindergarten-to-grade-12/reports/ab-hawd/ab-hawd-school-district-042.pdf"
                                                target="_blank">PDF</a></td>
                                <td><a href="https://www2.gov.bc.ca/assets/gov/education/administration/kindergarten-to-grade-12/reports/ab-hawd/ab-hawd-school-district-042.xlsx"
                                                target="_blank">Excel</a></td>
                        </tr>
                        <tr>
                                <th scope="row">Mission (75)</th>
                                <td><a href="https://www2.gov.bc.ca/assets/gov/education/administration/kindergarten-to-grade-12/reports/ab-hawd/ab-hawd-school-district-075.pdf"
                                                target="_blank">PDF</a></td>
                                <td><a href="https://www2.gov.bc.ca/assets/gov/education/administration/kindergarten-to-grade-12/reports/ab-hawd/ab-hawd-school-district-075.xlsx"
                                                target="_blank">Excel</a></td>
                        </tr>
                        <tr>
                                <th scope="row">Nanaimo-Ladysmith (68)</th>
                                <td><a href="https://www2.gov.bc.ca/assets/gov/education/administration/kindergarten-to-grade-12/reports/ab-hawd/ab-hawd-school-district-068.pdf"
                                                target="_blank">PDF</a></td>
                                <td><a href="https://www2.gov.bc.ca/assets/gov/education/administration/kindergarten-to-grade-12/reports/ab-hawd/ab-hawd-school-district-068.xlsx"
                                                target="_blank">Excel</a></td>
                        </tr>
                        <tr>
                                <th scope="row">Nechako Lakes (91)</th>
                                <td><a href="https://www2.gov.bc.ca/assets/gov/education/administration/kindergarten-to-grade-12/reports/ab-hawd/ab-hawd-school-district-091.pdf"
                                                target="_blank">PDF</a></td>
                                <td><a href="https://www2.gov.bc.ca/assets/gov/education/administration/kindergarten-to-grade-12/reports/ab-hawd/ab-hawd-school-district-091.xlsx"
                                                target="_blank">Excel</a></td>
                        </tr>
                        <tr>
                                <th scope="row">New Westminster (40)</th>
                                <td><a href="https://www2.gov.bc.ca/assets/gov/education/administration/kindergarten-to-grade-12/reports/ab-hawd/ab-hawd-school-district-040.pdf"
                                                target="_blank">PDF</a></td>
                                <td><a href="https://www2.gov.bc.ca/assets/gov/education/administration/kindergarten-to-grade-12/reports/ab-hawd/ab-hawd-school-district-040.xlsx"
                                                target="_blank">Excel</a></td>
                        </tr>
                        <tr>
                                <th scope="row">Nicola-Similkameen (58)</th>
                                <td><a href="https://www2.gov.bc.ca/assets/gov/education/administration/kindergarten-to-grade-12/reports/ab-hawd/ab-hawd-school-district-058.pdf"
                                                target="_blank">PDF</a></td>
                                <td><a href="https://www2.gov.bc.ca/assets/gov/education/administration/kindergarten-to-grade-12/reports/ab-hawd/ab-hawd-school-district-058.xlsx"
                                                target="_blank">Excel</a></td>
                        </tr>
                        <tr>
                                <th scope="row">Nisga'a (92)</th>
                                <td><a href="https://www2.gov.bc.ca/assets/gov/education/administration/kindergarten-to-grade-12/reports/ab-hawd/ab-hawd-school-district-092.pdf"
                                                target="_blank">PDF</a></td>
                                <td><a href="https://www2.gov.bc.ca/assets/gov/education/administration/kindergarten-to-grade-12/reports/ab-hawd/ab-hawd-school-district-092.xlsx"
                                                target="_blank">Excel</a></td>
                        </tr>
                        <tr>
                                <th scope="row">North Okanagan-Shuswap (83)</th>
                                <td><a href="https://www2.gov.bc.ca/assets/gov/education/administration/kindergarten-to-grade-12/reports/ab-hawd/ab-hawd-school-district-083.pdf"
                                                target="_blank">PDF</a></td>
                                <td><a href="https://www2.gov.bc.ca/assets/gov/education/administration/kindergarten-to-grade-12/reports/ab-hawd/ab-hawd-school-district-083.xlsx"
                                                target="_blank">Excel</a></td>
                        </tr>
                        <tr>
                                <th scope="row">North Vancouver (44)</th>
                                <td><a href="https://www2.gov.bc.ca/assets/gov/education/administration/kindergarten-to-grade-12/reports/ab-hawd/ab-hawd-school-district-044.pdf"
                                                target="_blank">PDF</a></td>
                                <td><a href="https://www2.gov.bc.ca/assets/gov/education/administration/kindergarten-to-grade-12/reports/ab-hawd/ab-hawd-school-district-044.xlsx"
                                                target="_blank">Excel</a></td>
                        </tr>
                        <tr>
                                <th scope="row">Okanagan Similkameen (53)</th>
                                <td><a href="https://www2.gov.bc.ca/assets/gov/education/administration/kindergarten-to-grade-12/reports/ab-hawd/ab-hawd-school-district-053.pdf"
                                                target="_blank">PDF</a></td>
                                <td><a href="https://www2.gov.bc.ca/assets/gov/education/administration/kindergarten-to-grade-12/reports/ab-hawd/ab-hawd-school-district-053.xlsx"
                                                target="_blank">Excel</a></td>
                        </tr>
                        <tr>
                                <th scope="row">Okanagan Skaha (67)</th>
                                <td><a href="https://www2.gov.bc.ca/assets/gov/education/administration/kindergarten-to-grade-12/reports/ab-hawd/ab-hawd-school-district-067.pdf"
                                                target="_blank">PDF</a></td>
                                <td><a href="https://www2.gov.bc.ca/assets/gov/education/administration/kindergarten-to-grade-12/reports/ab-hawd/ab-hawd-school-district-067.xlsx"
                                                target="_blank">Excel</a></td>
                        </tr>
                        <tr>
                                <th scope="row">Pacific Rim (70)</th>
                                <td><a href="https://www2.gov.bc.ca/assets/gov/education/administration/kindergarten-to-grade-12/reports/ab-hawd/ab-hawd-school-district-070.pdf"
                                                target="_blank">PDF</a></td>
                                <td><a href="https://www2.gov.bc.ca/assets/gov/education/administration/kindergarten-to-grade-12/reports/ab-hawd/ab-hawd-school-district-070.xlsx"
                                                target="_blank">Excel</a></td>
                        </tr>
                        <tr>
                                <th scope="row">Peace River North (60)</th>
                                <td><a href="https://www2.gov.bc.ca/assets/gov/education/administration/kindergarten-to-grade-12/reports/ab-hawd/ab-hawd-school-district-060.pdf"
                                                target="_blank">PDF</a></td>
                                <td><a href="https://www2.gov.bc.ca/assets/gov/education/administration/kindergarten-to-grade-12/reports/ab-hawd/ab-hawd-school-district-060.xlsx"
                                                target="_blank">Excel</a></td>
                        </tr>
                        <tr>
                                <th scope="row">Peace River South (59)</th>
                                <td><a href="https://www2.gov.bc.ca/assets/gov/education/administration/kindergarten-to-grade-12/reports/ab-hawd/ab-hawd-school-district-059.pdf"
                                                target="_blank">PDF</a></td>
                                <td><a href="https://www2.gov.bc.ca/assets/gov/education/administration/kindergarten-to-grade-12/reports/ab-hawd/ab-hawd-school-district-059.xlsx"
                                                target="_blank">Excel</a></td>
                        </tr>

                        <tr>
                                <th scope="row">Prince George (57)</th>
                                <td><a href="https://www2.gov.bc.ca/assets/gov/education/administration/kindergarten-to-grade-12/reports/ab-hawd/ab-hawd-school-district-057.pdf"
                                                target="_blank">PDF</a></td>
                                <td><a href="https://www2.gov.bc.ca/assets/gov/education/administration/kindergarten-to-grade-12/reports/ab-hawd/ab-hawd-school-district-057.xlsx"
                                                target="_blank">Excel</a></td>
                        </tr>
                        <tr>
                                <th scope="row">Prince Rupert (52)</th>
                                <td><a href="https://www2.gov.bc.ca/assets/gov/education/administration/kindergarten-to-grade-12/reports/ab-hawd/ab-hawd-school-district-052.pdf"
                                                target="_blank">PDF</a></td>
                                <td><a href="https://www2.gov.bc.ca/assets/gov/education/administration/kindergarten-to-grade-12/reports/ab-hawd/ab-hawd-school-district-052.xlsx"
                                                target="_blank">Excel</a></td>
                        </tr>
                        <tr>
                                <th scope="row">qathet (47)</th>
                                <td><a href="https://www2.gov.bc.ca/assets/gov/education/administration/kindergarten-to-grade-12/reports/ab-hawd/ab-hawd-school-district-047.pdf"
                                                target="_blank">PDF</a></td>
                                <td><a href="https://www2.gov.bc.ca/assets/gov/education/administration/kindergarten-to-grade-12/reports/ab-hawd/ab-hawd-school-district-047.xlsx"
                                                target="_blank">Excel</a></td>
                        </tr>
                        <tr>
                                <th scope="row">Qualicum (69)</th>
                                <td><a href="https://www2.gov.bc.ca/assets/gov/education/administration/kindergarten-to-grade-12/reports/ab-hawd/ab-hawd-school-district-069.pdf"
                                                target="_blank">PDF</a></td>
                                <td><a href="https://www2.gov.bc.ca/assets/gov/education/administration/kindergarten-to-grade-12/reports/ab-hawd/ab-hawd-school-district-069.xlsx"
                                                target="_blank">Excel</a></td>
                        </tr>
                        <tr>
                                <th scope="row">Quesnel (28)</th>
                                <td><a href="https://www2.gov.bc.ca/assets/gov/education/administration/kindergarten-to-grade-12/reports/ab-hawd/ab-hawd-school-district-028.pdf"
                                                target="_blank">PDF</a></td>
                                <td><a href="https://www2.gov.bc.ca/assets/gov/education/administration/kindergarten-to-grade-12/reports/ab-hawd/ab-hawd-school-district-028.xlsx"
                                                target="_blank">Excel</a></td>
                        </tr>
                        <tr>
                                <th scope="row">Revelstoke (19)</th>
                                <td><a href="https://www2.gov.bc.ca/assets/gov/education/administration/kindergarten-to-grade-12/reports/ab-hawd/ab-hawd-school-district-019.pdf"
                                                target="_blank">PDF</a></td>
                                <td><a href="https://www2.gov.bc.ca/assets/gov/education/administration/kindergarten-to-grade-12/reports/ab-hawd/ab-hawd-school-district-019.xlsx"
                                                target="_blank">Excel</a></td>
                        </tr>
                        <tr>
                                <th scope="row">Richmond (38)</th>
                                <td><a href="https://www2.gov.bc.ca/assets/gov/education/administration/kindergarten-to-grade-12/reports/ab-hawd/ab-hawd-school-district-038.pdf"
                                                target="_blank">PDF</a></td>
                                <td><a href="https://www2.gov.bc.ca/assets/gov/education/administration/kindergarten-to-grade-12/reports/ab-hawd/ab-hawd-school-district-038.xlsx"
                                                target="_blank">Excel</a></td>
                        </tr>
                        <tr>
                                <th scope="row">Rocky Mountain (6)</th>
                                <td><a href="https://www2.gov.bc.ca/assets/gov/education/administration/kindergarten-to-grade-12/reports/ab-hawd/ab-hawd-school-district-006.pdf"
                                                target="_blank">PDF</a></td>
                                <td><a href="https://www2.gov.bc.ca/assets/gov/education/administration/kindergarten-to-grade-12/reports/ab-hawd/ab-hawd-school-district-006.xlsx"
                                                target="_blank">Excel</a></td>
                        </tr>
                        <tr>
                                <th scope="row">Saanich (63)</th>
                                <td><a href="https://www2.gov.bc.ca/assets/gov/education/administration/kindergarten-to-grade-12/reports/ab-hawd/ab-hawd-school-district-063.pdf"
                                                target="_blank">PDF</a></td>
                                <td><a href="https://www2.gov.bc.ca/assets/gov/education/administration/kindergarten-to-grade-12/reports/ab-hawd/ab-hawd-school-district-063.xlsx"
                                                target="_blank">Excel</a></td>
                        </tr>
                        <tr>
                                <th scope="row">Sea to Sky (48)</th>
                                <td><a href="https://www2.gov.bc.ca/assets/gov/education/administration/kindergarten-to-grade-12/reports/ab-hawd/ab-hawd-school-district-048.pdf"
                                                target="_blank">PDF</a></td>
                                <td><a href="https://www2.gov.bc.ca/assets/gov/education/administration/kindergarten-to-grade-12/reports/ab-hawd/ab-hawd-school-district-048.xlsx"
                                                target="_blank">Excel</a></td>
                        </tr>
                        <tr>
                                <th scope="row">Sooke (62)</th>
                                <td><a href="https://www2.gov.bc.ca/assets/gov/education/administration/kindergarten-to-grade-12/reports/ab-hawd/ab-hawd-school-district-062.pdf"
                                                target="_blank">PDF</a></td>
                                <td><a href="https://www2.gov.bc.ca/assets/gov/education/administration/kindergarten-to-grade-12/reports/ab-hawd/ab-hawd-school-district-062.xlsx"
                                                target="_blank">Excel</a></td>
                        </tr>
                        <tr>
                                <th scope="row">Southeast Kootenay (5)</th>
                                <td><a href="https://www2.gov.bc.ca/assets/gov/education/administration/kindergarten-to-grade-12/reports/ab-hawd/ab-hawd-school-district-005.pdf"
                                                target="_blank">PDF</a></td>
                                <td><a href="https://www2.gov.bc.ca/assets/gov/education/administration/kindergarten-to-grade-12/reports/ab-hawd/ab-hawd-school-district-005.xlsx"
                                                target="_blank">Excel</a></td>
                        </tr>
                        <tr>
                                <th scope="row">Stikine (87)</th>
                                <td><a href="https://www2.gov.bc.ca/assets/gov/education/administration/kindergarten-to-grade-12/reports/ab-hawd/ab-hawd-school-district-087.pdf"
                                                target="_blank">PDF</a></td>
                                <td><a href="https://www2.gov.bc.ca/assets/gov/education/administration/kindergarten-to-grade-12/reports/ab-hawd/ab-hawd-school-district-087.xlsx"
                                                target="_blank">Excel</a></td>
                        </tr>
                        <tr>
                                <th scope="row">Sunshine Coast (46)</th>
                                <td><a href="https://www2.gov.bc.ca/assets/gov/education/administration/kindergarten-to-grade-12/reports/ab-hawd/ab-hawd-school-district-046.pdf"
                                                target="_blank">PDF</a></td>
                                <td><a href="https://www2.gov.bc.ca/assets/gov/education/administration/kindergarten-to-grade-12/reports/ab-hawd/ab-hawd-school-district-046.xlsx"
                                                target="_blank">Excel</a></td>
                        </tr>
                        <tr>
                                <th scope="row">Surrey (36)</th>
                                <td><a href="https://www2.gov.bc.ca/assets/gov/education/administration/kindergarten-to-grade-12/reports/ab-hawd/ab-hawd-school-district-036.pdf"
                                                target="_blank">PDF</a></td>
                                <td><a href="https://www2.gov.bc.ca/assets/gov/education/administration/kindergarten-to-grade-12/reports/ab-hawd/ab-hawd-school-district-036.xlsx"
                                                target="_blank">Excel</a></td>
                        </tr>
                        <tr>
                                <th scope="row">Vancouver (39)</th>
                                <td><a href="https://www2.gov.bc.ca/assets/gov/education/administration/kindergarten-to-grade-12/reports/ab-hawd/ab-hawd-school-district-039.pdf"
                                                target="_blank">PDF</a></td>
                                <td><a href="https://www2.gov.bc.ca/assets/gov/education/administration/kindergarten-to-grade-12/reports/ab-hawd/ab-hawd-school-district-039.xlsx"
                                                target="_blank">Excel</a></td>
                        </tr>
                        <tr>
                                <th scope="row">Vancouver Island North (85)</th>
                                <td><a href="https://www2.gov.bc.ca/assets/gov/education/administration/kindergarten-to-grade-12/reports/ab-hawd/ab-hawd-school-district-085.pdf"
                                                target="_blank">PDF</a></td>
                                <td><a href="https://www2.gov.bc.ca/assets/gov/education/administration/kindergarten-to-grade-12/reports/ab-hawd/ab-hawd-school-district-085.xlsx"
                                                target="_blank">Excel</a></td>
                        </tr>
                        <tr>
                                <th scope="row">Vancouver Island West (84)</th>
                                <td><a href="https://www2.gov.bc.ca/assets/gov/education/administration/kindergarten-to-grade-12/reports/ab-hawd/ab-hawd-school-district-084.pdf"
                                                target="_blank">PDF</a></td>
                                <td><a href="https://www2.gov.bc.ca/assets/gov/education/administration/kindergarten-to-grade-12/reports/ab-hawd/ab-hawd-school-district-084.xlsx"
                                                target="_blank">Excel</a></td>
                        </tr>
                        <tr>
                                <th scope="row">Vernon (22)</th>
                                <td><a href="https://www2.gov.bc.ca/assets/gov/education/administration/kindergarten-to-grade-12/reports/ab-hawd/ab-hawd-school-district-022.pdf"
                                                target="_blank">PDF</a></td>
                                <td><a href="https://www2.gov.bc.ca/assets/gov/education/administration/kindergarten-to-grade-12/reports/ab-hawd/ab-hawd-school-district-022.xlsx"
                                                target="_blank">Excel</a></td>
                        </tr>
                        <tr>
                                <th scope="row">West Vancouver (45)</th>
                                <td><a href="https://www2.gov.bc.ca/assets/gov/education/administration/kindergarten-to-grade-12/reports/ab-hawd/ab-hawd-school-district-045.pdf"
                                                target="_blank">PDF</a></td>
                                <td><a href="https://www2.gov.bc.ca/assets/gov/education/administration/kindergarten-to-grade-12/reports/ab-hawd/ab-hawd-school-district-045.xlsx"
                                                target="_blank">Excel</a></td>
                        </tr>
                </tbody>
        </table>
</section>

@endsection