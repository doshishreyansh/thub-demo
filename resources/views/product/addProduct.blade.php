@extends('layout.layout')
@section('content')
<div class="cont">
    <h1>Add Product</h1>

    <div class="alert alert-success hide" role="alert">
    </div>
    <div class="alert alert-danger hide" role="alert">
        Please select or enter all the required fields. For more details, Please check console.
    </div>

    <form id="productForm" method="post">
        <div class="form-group">
            <label for="exampleInputEmail1">Species <span class="error">*</span></label>
            <select class="form-control species" name="species_id" required>
                <option></option>
                @foreach ($getSpecies as $k=>$species)
                <option value="{{ $species->id}}">{{ $species->name }}</option>
                @endforeach
            </select>
        </div>
        <div class="form-group">
            <label for="exampleInputEmail1">Grading System <span class="error">*</span></label>
            <div class="radio">
                <span class="form-check">
                    <input class="form-check-input" value="1" type="radio" name="grade_system" id="radio_nordic_blue">
                    <label class="form-check-label" for="radio_nordic_blue">
                        Nordic Blue
                    </label>
                </span>
                <span class="form-check">
                    <input class="form-check-input" value="2" type="radio" name="grade_system" id="radio_tegernseer">
                    <label class="form-check-label" for="radio_tegernseer">
                        Tegernseer
                    </label>
                </span>
            </div>
        </div>

        <div class="form-group grade1">
            <label for="exampleInputEmail1">Grade <span class="error">*</span></label>
            <select class="form-control grade" name="grade_id" required>
            </select>
        </div>

        <div class="form-group grade2">
            <label for="exampleInputEmail1">Drying Methods <span class="error">*</span></label>
            <select class="form-control drying_method" name="drying_method_id" required>
                <option></option>
                @foreach ($getDryingMethods as $k=>$dryingMethod)
                <option value="{{ $dryingMethod->id}}">{{ $dryingMethod->name }}</option>
                @endforeach
            </select>
        </div>

        <div class="form-group grade2">
            <label for="exampleInputEmail1">Treatment</label>
            <select class="form-control treatment" name="treatment_id">
                <option></option>
                @foreach ($getTreatments as $k=>$treatment)
                <option value="{{ $treatment->id}}">{{ $treatment->name }}</option>
                @endforeach
            </select>
        </div>
        <div class="form-group">
            <h4 for="exampleInputPassword1">Dimentions</h4>
        </div>
        <div class="inputInRow">
            <span class="form-group">
                <label for="exampleInputEmail1">Thickness <span class="error">*</span></label>
                <input type="number" min="0" class="form-control" name="thickness" id="thickness"
                    placeholder="Thickness" required>
            </span>
            <span class="x-center">X</span>
            <span class="form-group">
                <label for="exampleInputEmail1">Width <span class="error">*</span></label>
                <input type="number" min="0" class="form-control" name="width" id="width" placeholder="Width" required>
            </span>
            <span class="x-center">X</span>
            <span class="form-group">
                <label for="exampleInputEmail1">Length <span class="error">*</span></label>
                <input type="number" min="0" class="form-control" name="length" id="length" placeholder="Length"
                    required>
            </span>
        </div>

        <button type="submit" class="btn btn-primary sendData">Submit</button>
    </form>
</div>

@endsection
@section('jsscript')
<script>
    let getGrades = <?php echo json_encode($getGrades); ?>;

    $(document).ready(function() {
        initDropDowns();

        // change grades based on selected grading system
        $('input[name="grade_system"]:radio').change(function () {
            var gradeId = $("input[name='grade_system']:checked").val();

            $('select[name="grade_id"]' ).html('');

            var typeOptionsString = '';
            getGrades.map((grade) => {
                if(grade.grade_system === parseInt(gradeId)){
                    typeOptionsString += "<option value='" + grade.id + "'>" + grade.name + "</option>";
                }
            });

            $( 'select[name="grade_id"]' ).append(typeOptionsString);
            $( 'select[name="grade_id"]' ).select2().trigger('change');
        });

        $("input[name='grade_system'][value='1']").attr('checked', true).trigger('change');  
    
        $("#productForm").submit(function(e){
            e.preventDefault();
            let data  = new FormData(); 
            var form_data = $('#productForm').serializeArray();
            $.each(form_data, function (key, input) {
                data.append(input.name, input.value);
            });
                      
            $.ajax({
                url: "http://127.0.0.1:8000/product",
                method: 'POST',
                data: data,
                processData: false,
                contentType: false,
                headers: {
                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                },
                success: function (response) {
                    $(".alert-danger").hide();
                    $(".alert-success").text(response.message);
                    $(".alert-success").show(); 
                    resetForm();

                    $("html, body").animate({ scrollTop: 0 }, "slow");
                },
                error: function (error) {
                    $(".alert-success").hide();
                    $(".alert-danger").show();
                    //print error in console
                    console.log(error.responseJSON);
                    $("html, body").animate({ scrollTop: 0 }, "slow");
                }
            });              
        });

    });

    function initDropDowns(){
        $('.species').select2({    
            "placeholder":"Select Species"
        });
        $('.grade').select2({    
            "placeholder":"Select Grade"
        });
        $('.drying_method').select2({    
            "placeholder":"Select Drying Method"
        });
        $('.treatment').select2({    
            "placeholder":"Select Treatment"
        });
    }

    function resetForm() {
        $('.species').val(null).trigger("change");
        $('.drying_method').val(null).trigger("change");
        $('.treatment').val(null).trigger("change");

        $('#productForm')[0].reset();
    }
</script>
@endsection