@section('content')
<!-- page start-->
<div class="row">
    <aside class="profile-nav col-lg-3">
        <section class="panel">
            <div class="user-heading round">
                <a href="#">
                    <img src="{{ asset('img/profile-avatar.jpg') }}" alt="">
                </a>
                <h1>{{ $detail->name_first.' '.$detail->name_last }}</h1>
                <p>{{ $detail->employee_number }}</p>
            </div>

            <ul class="nav nav-pills nav-stacked">
                <li class="active"><a href="{{ url('backend/profile') }}"> <i class="fa fa-user"></i> Profile </a></li>
                <li><a href="{{ url('backend/profiledetail') }}"> <i class="fa fa-calendar"></i> History <span class="label label-danger pull-right r-activity">9</span></a></li>
            </ul>

        </section>
    </aside>
    <aside class="profile-info col-lg-9">
        <section class="panel">
            <div class="panel-body bio-graph-info">
                <h1>Bio Graph</h1>
                <div class="row">
                    <div class="bio-row">
                        <p><span>First Name </span>: {{ $detail->name_first }}</p>
                    </div>
                    <div class="bio-row">
                        <p><span>Last Name </span>: {{ $detail->name_last }}</p>
                    </div>
                    <div class="bio-row">
                        <p><span>Country </span>: {{ $detail->country->name }}</p>
                    </div>
                    <div class="bio-row">
                        <p><span>Birthday</span>: {{ $detail->birth_date }}</p>
                    </div>
                    <div class="bio-row">
                        <p><span>Occupation </span>: - </p>
                    </div>
                    <div class="bio-row">
                        <p><span>Email </span>: {{ $detail->user->email }} </p>
                    </div>
                    <div class="bio-row">
                        <p><span>Mobile </span>: {{ $detail->mobile_number }}</p>
                    </div>
                    <div class="bio-row">
                        <p><span>Phone </span>: {{ $detail->phone_number }}</p>
                    </div>
                </div>
            </div>
        </section>

        <section class="panel">
            <div class="panel-body progress-panel">
                <div class="task-progress">
                    <h1>Family List</h1>
                </div>
            </div>
            <table class="table table-striped table-advance table-hover">
                <thead>
                <tr>
                    <th>Status</th>
                    <th>Name</th>
                    <th>Date Of Birth</th>
                    <!--                        <th>Phone Number</th>-->
                    <th>Action</th>
                </tr>
                </thead>
                <tbody>
                @foreach($detail->family as $family)
                <tr>
                    <td>{{ $family->status->name }}</td>
                    <td>{{ $family->title_front.' '.$family->name_first.' '.$family->name_last.' '.$family->title_end }}</td>
                    <td>{{ $family->birth_date }}</td>
                    <td>
                        <a class="btn btn-success btn-xs detailButton" data-id="{{ $family->id }}" href="#"><i class="fa fa-eye"></i></a>
                        <a class="btn btn-primary btn-xs" data-toggle="modal" data-id="{{ $family->id }}" href="#updateModal"><i class="fa fa-edit"></i></a>
                        <a class="btn btn-danger btn-xs" data-toggle="modal" data-id="{{ $family->id }}" href="#deleteModal"><i class="fa fa-trash-o "></i></a>
                    </td>
                </tr>
                @endforeach
                </tbody>
            </table>
        </section>

    </aside>
</div>
<!-- page end-->

<!--modal-->
<div class="modal fade" id="detailModal" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
                <h4 class="modal-title">Detail </h4>
            </div>
            <div class="modal-body">

                Body goes here...

            </div>
            <div class="modal-footer">
                <button data-dismiss="modal" class="btn btn-default" type="button">Close</button>
                <button class="btn btn-success" type="button">Save changes</button>
            </div>
        </div>
    </div>
</div>

<div class="modal fade" id="updateModal" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
                <h4 class="modal-title">Detail </h4>
            </div>
            <div class="modal-body">

                Body goes here...

            </div>
            <div class="modal-footer">
                <button data-dismiss="modal" class="btn btn-default" type="button">Close</button>
                <button class="btn btn-success" type="button">Save changes</button>
            </div>
        </div>
    </div>
</div>
<!--endmodal-->
@stop

@section('customjs')
<script type="application/javascript">
    $(function() {

        $(".detailButton").on("click", function(e){
            familyId = $(".detailButton").data("id");
            request = $.get("{{ url('api/v1/employee/family/detail') }}", { id: familyId });
            request.done(function( data ) {
                alert(data);
            });
//            $("#detailModal").modal("show");
            e.preventDefault();
        });
    });
</script>
@stop