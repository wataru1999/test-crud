@extends('app')

@section('title', 'Students')

@push('scripts')
<script src="https://code.jquery.com/jquery-3.5.1.min.js" integrity="sha256-9/aliU8dGd2tb6OSsuzixeV4y/faTqgFtohetphbbj0=" crossorigin="anonymous"></script>

<script>

  $(document).ready(function() {
  $(document).on("click", "#edit-item", function() {
      $(this).addClass("edit-item-trigger-clicked"); //useful for identifying which trigger was clicked and consequently grab data from the correct row and not the wrong one.
      var options = {
          backdrop: "static"
      };
      $("#edit-modal").modal(options);
      var el = $(".edit-item-trigger-clicked"); // See how its usefull right here?
      var row = el.closest(".data-row");
      // get the data
      var student_id = el.data("item-student_id");
      var first_name = el.data("item-first_name");
      var last_name = el.data("item-last_name");
      var section = el.data("item-section");

      // var description = row.children("item-email").text();
      // fill the data in the input fields
      $("#editStudentID").val(student_id);
      $("#editFirstname").val(first_name);
      $("#editLastname").val(last_name);
      $("#editSection").val(section);

 
  });
  // on modal hide
  $("#edit-modal").on("hide.bs.modal", function() {
      $(".edit-item-trigger-clicked").removeClass(
          "edit-item-trigger-clicked"
      );
      $("#edit-form").trigger("reset");
  });
});

</script>

@endpush


@section('content')

<!-- Button trigger modal -->
<button type="button" class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#addModal">
  ADD
</button>

<table class="table">
  <thead>
    <tr>
      <th scope="col">#</th>
      <th scope="col">Firstname</th>
      <th scope="col">Lastname</th>
      <th scope="col">Section</th>
      <th scope="col">Actions</th>
    </tr>
  </thead>
  <tbody>

    @foreach ($students as $student)

    <tr>
      <th scope="row">{{ $student->student_id }}</th>
      <td>{{ $student->first_name }}</td>
      <td>{{ $student->last_name}}</td>
      <td>{{ $student->section }}</td>
      <td col-2>
      
      <!-- Button trigger modal -->
      <button 
      type="button"
      class="btn btn-primary" 
      data-bs-toggle="modal" 
      data-bs-target="#edit-modal"

      data-item-student_id="{{ $student->student_id }}"
      data-item-first_name="{{ $student->first_name }}"
      data-item-last_name="{{ $student->last_name }}"
      data-item-section="{{ $student->section }}"
      
      id="edit-item">
      Edith
      </button>

      {{-- Delete --}}
      <form method="POST" action="students/{{ $student->student_id }}">
        @method('DELETE')
        @csrf

        <button type="submit" class="btn btn-danger"> Delethe </button> 

      </form>
       
      </td>
    </tr>
    @endforeach
    
  
  </tbody>
</table>

{{ $students->render("pagination::bootstrap-4") }}



<!-- Modal -->
<div class="modal fade" id="addModal" tabindex="-1" aria-labelledby="addModalLabel" aria-hidden="true">
  <div class="modal-dialog">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="addModalLabel">Modal title</h5>
        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
      </div>

      <div class="modal-body">
        <form method="POST" action="{{ route('student.store') }}">
          @csrf
        
          {{-- Firstname --}}
          <div class="mb-3">
            <label for="inputFirstname" class="form-label">First Name</label>
            <input type="text" class="form-control" id="inputFirstname" name="inputFirstname" placeholder="ex. Tite" required>
          </div>

          {{-- Lastname --}}
          <div class="mb-3">
            <label for="inputLastname" class="form-label">Last Name</label>
            <input type="text" class="form-control" id="inputLasttname" name="inputLastname" placeholder="ex. Mo" required>
          </div>

          {{-- Section --}}
          <div class="mb-3">
            <label for="inputSection" class="form-label">Section</label>
            <input type="text" class="form-control" id="inputSection" name="inputSection" placeholder="ex. 3A" required>
          </div>

          <div class="modal-footer">
            <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
            <button type="submit" class="btn btn-primary">Save changes</button>
          </div>

        </form>
      </div>

     
    </div>
  </div>
</div>

<!-- Edit Modal -->
<div class="modal fade" id="edit-modal" tabindex="-1" aria-labelledby="editModalLabel" aria-hidden="true">
  <div class="modal-dialog">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="editModalLabel">Modal title</h5>
        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
      </div>
      <div class="modal-body">

        <form method="POST" action="{{ route('student.update') }}">
          @method('PUT')
          @csrf

          {{-- Student ID --}}
          <div class="mb-3">
            <label for="editStudentID" class="form-label">Student ID</label>
            <input type="text" class="form-control" id="editStudentID" name="editStudentID" placeholder="ex. Tite" required readonly>
          </div>
        
          {{-- Firstname --}}
          <div class="mb-3">
            <label for="editFirstname" class="form-label">First Name</label>
            <input type="text" class="form-control" id="editFirstname" name="editFirstname" placeholder="ex. Tite" required>
          </div>

          {{-- Lastname --}}
          <div class="mb-3">
            <label for="editLastname" class="form-label">Last Name</label>
            <input type="text" class="form-control" id="editLastname" name="editLastname" placeholder="ex. Mo" required>
          </div>

          {{-- Section --}}
          <div class="mb-3">
            <label for="editSection" class="form-label">Section</label>
            <input type="text" class="form-control" id="editSection" name="editSection" placeholder="ex. 3A" required>
          </div>

          <div class="modal-footer">
            <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
            <button type="submit" class="btn btn-primary">Save changes</button>
          </div>

        </form>

      </div>
    </div>
  </div>
</div>

@endsection