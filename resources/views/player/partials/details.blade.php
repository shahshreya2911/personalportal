 <div class="row">
    <div class="col-md-6">
       
        <div class="form-group">
            <label for="name">Name</label>
            <input type="text" class="form-control " id="name"
                   name="name" placeholder="Enter Name " >
        </div>
        <div class="form-group">
            <label for="age">Age</label>
            <input type="text" class="form-control " id="age"
                   name="age" placeholder="Enter Age " >
        </div>
        <div class="form-group">
            <label for="weight">Weight</label>
            <input type="text" class="form-control" id="weight"
                   name="weight" placeholder="Enter Weight " >
        </div>
        <div class="form-group">
            <label for="gender">Gender</label> <br> 
            <input type="radio" name="gender" value="Male" > Male <br> 
            <input type="radio" name="gender" value="Female" > Female
        </div>
        <div class="form-group">
            <label for="sports">Select Sports </label>
            <select class="form-control " id="sports" name="sports" onchange="getWeightCat()">
                <option value=""> Select Sports  </option>
                @foreach ($sports as $data)
                    <option value="{{$data->id}}"> {{$data->name}} </option>
                @endforeach
            </select>
        </div>
        <div class="form-group">
            <label for="weight_cat">Select Weight Category </label>
            <select class="form-control " id="weight_cat" name="weight_cat" >
            </select>
        </div>
        <div id='demo'></div>
    </div>

  

    @if ($edit)
        <div class="col-md-12 mt-2">
            <button type="submit" class="btn btn-primary" id="update-details-btn">
                <i class="fa fa-refresh"></i>
                @lang('app.update_details')
            </button>
        </div>
    @endif
</div>
