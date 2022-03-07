<div>
    <form method="POST" action="{{route('appointments.store')}}" enctype="multipart/form-data">
        @csrf
        @method('POST')
        <div class="row">
            <div class="col-sm-6">
                <!-- text input -->
                <div class="form-group">
                    <label>Date</label>
                    <input type="date" value=""  name="date" class="form-control" placeholder="Enter date">
                </div>
            </div>
            <div class="col-sm-6">
                <!-- select -->
                <div class="form-group">
                    <label> Service</label>
                    <select class="form-control" wire:model="service" name="service_id" >

                        <option>Select Service</option>

                        @foreach ($services as $service)
                        <option value="{{$service->id}}">{{$service->name}}</option>
                        @endforeach
                    </select>
                </div>
            </div>
        </div>
        <input type="text" name="user_id" hidden value="{{Auth::user()->id}}">
        <input type="text" hidden name="status" value="pending">
        <div class="row">
            <!-- checkbox -->
            @foreach ($subservices as $subservice)
            <div class="col-md-3">
                <div class="form-group">
                    <img src="{{asset('/admin/dist/img/user1-128x128.jpg')}}" alt="">
                    <div class="form-check">
                        <input wire:model="subservice" class="form-check-input" value="{{$subservice->id}}" name="subservice_id" type="radio">
                        <label class="form-check-label" >Select </label>
                    </div>
                </div>
            </div>
            @endforeach
            {{-- {{ $subservices->links('pagination::bootstrap-4')}} --}}

        </div>

        <div class="row">
            <div class="col-md-12">

                <textarea name="description" id="" cols="100" rows="5"
                    placeholder="Add your description here..."></textarea>

            </div>

        </div>
        <div class="row">
            <div class="col-md-12">
                <hr>
                <hr>

                <div style="margin-left: 45%">
                    <button type="submit" class="btn  btn-warning">Book</button>
                </div>
                <hr>
            </div>
        </div>
    </form>
</div>
