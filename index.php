<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.5.3/dist/css/bootstrap.min.css" integrity="sha384-TX8t27EcRE3e/ihU7zmQxVncDAy5uIKz4rEkgIXeMed4M0jlfIDPvg6uqKI2xXr2" crossorigin="anonymous">
    <title>Document</title>
    <style>
        body {
            font-family: Arial, sans-serif;
        }
        button {
            padding: 10px 20px;
            font-size: 16px;
            cursor: pointer;
            background-color: #4CAF50;
            color: white;
            border: none;
            margin: 20px 0px 0px 700px;
            border-radius: 5px;
            transition: background-color 0.3s ease;
        }
        button:hover {
            background-color: #45a049;
        }
        .modal {
            display: none;
            position: fixed;
            z-index: 1;
            left: 0;
            top: 0;
            width: 100%;
            height: 100%;
            overflow: auto;
            background-color: rgba(0, 0, 0, 0.4);
            padding-top: 60px;
        }
        .modal-content {
            background-color: #fefefe;
            margin: 5% auto;
            padding: 20px;
            border: 1px solid #888;
            width: 80%;
            border-radius: 10px;
            box-shadow: 0 5px 15px rgba(0, 0, 0, 0.3);
            animation: modalopen 0.5s;
        }
        @keyframes modalopen {
            from { opacity: 0; }
            to { opacity: 1; }
        }
        .close {
            color: #aaa;
            float: right;
            font-size: 28px;
            font-weight: bold;
        }
        .close:hover,
        .close:focus {
            color: black;
            text-decoration: none;
            cursor: pointer;
        }
        form {
            display: flex;
            flex-direction: column;
        }
        label {
            margin-top: 10px;
        }
        input, select {
            padding: 10px;
            margin-top: 5px;
            width: 100%;
            box-sizing: border-box;
            border: 1px solid #ccc;
            border-radius: 5px;
        }
        .gender-container {
            display: flex;
            margin-top: 5px;
        }
        .radio-container {
            margin-right: 15px;
            position: relative;
            padding-left: 25px;
            cursor: pointer;
            font-size: 16px;
            user-select: none;
        }
        .radio-container input {
            position: absolute;
            opacity: 0;
            cursor: pointer;
        }
        .checkmark {
            position: absolute;
            top: 0;
            left: 0;
            height: 20px;
            width: 20px;
            background-color: #ccc;
            border-radius: 50%;
        }
        .radio-container:hover input ~ .checkmark {
            background-color: #b5b5b5;
        }
        .radio-container input:checked ~ .checkmark {
            background-color: #4CAF50;
        }
        .checkmark:after {
            content: "";
            position: absolute;
            display: none;
        }
        .radio-container input:checked ~ .checkmark:after {
            display: block;
        }
        .radio-container .checkmark:after {
            top: 7px;
            left: 7px;
            width: 6px;
            height: 6px;
            border-radius: 50%;
            background: white;
        }
        .btn{
            margin-top: 20px;
            padding: 10px;
            background-color: #4CAF50;
            color: white;
        }
        .btn:hover {
            background-color: #45a049;
        }
        .dbtn {
            background: red;
            color: white;
            border: 0;
            padding: 4px 10px;
            border-radius: 3px;
            cursor: pointer;
        }
        .dbtn:hover {
            background: red;
            color: white;
            text-decoration: none;
            padding: 4px 10px;
        }
        .edtbtn {
            background: skyblue;
            color: #fff;
            border: 0;
            padding: 4px 10px;
            border-radius: 3px;
            cursor: pointer;
        }
        .edtbtn:hover {
            background: skyblue;
            color: #fff;
            text-decoration: none;
            padding: 4px 10px;
        }
        ul.pagination {
            display: flex;
            list-style-type: none;
            padding: 0;
            margin-left: 700px;
        }
        ul.pagination li {
            margin: 0 5px;
        }
        ul.pagination li a {
            text-decoration: none;
            padding: 5px 10px;
            border: 2px solid black;
        }
        ul.pagination li a.active {
            background-color: #007BFF;
            color: white;
            border: 1px solid #007BFF;
        }
        .i1
        {
            width:20%;
            margin-left: 50px;
            margin-top: 15px;
        }
        .b1
        {
            width:10%;
            margin-left: 360px;
            margin-top: -45px;
        }
    </style>
</head>
<body>


    <?php
     $conn = mysqli_connect('localhost','root','','work');

     $search = isset($_GET['search']) ? $_GET['search'] : '';

        $search_query = "";
        if ($search) {
            $search_query = "WHERE fnm LIKE '%$search%' ";
        }
    $results_per_page = 3;

    $sql = "SELECT COUNT(id) AS total FROM student";
    $result = $conn->query($sql);
    $row = $result->fetch_assoc();
    $total_pages = ceil($row["total"] / $results_per_page);
    
   
    if (!isset($_GET['page'])) {
        $page = 1;
    } else {
        $page = $_GET['page'];
    }
    

    $starting_limit = ($page - 1) * $results_per_page;
    
    $sql = "SELECT * FROM student $search_query LIMIT " . $starting_limit . ',' . $results_per_page;
    $result = $conn->query($sql);
    ?>
    
    <button id="openFormBtn" datamodel="form.php">Open Form</button>
    <div id="popupForm" class="modal">
        <div class="modal-content">
            <span class="close">&times;</span>
            <form action="formpro.php" method="POST">
                <label for="firstName">First Name:</label>
                <input type="text" id="firstName" name="fnm" required>
                <label for="lastName">Last Name:</label>
                <input type="text" id="lastName" name="lnm" required>
                <div class="gender-container">
                    <label class="radio-container">Male
                        <input type="radio" name="gender" value="male" required>
                        <span class="checkmark"></span>
                    </label>
                    <label class="radio-container">Female
                        <input type="radio" name="gender" value="female" required>
                        <span class="checkmark"></span>
                    </label>
                </div>
                <label for="age">Age:</label>
                <input type="number" id="age" name="age" required>
                <label for="state">State:</label>
                <select name="state" id="state"required>
                    <option value="">--Select State--</option>
                    
                </select>
                <label for="city">City:</label>
                <select name="city" id="city" required>
                    <option value="">--Select city--</option>
                    
                </select>

                <label>Subject:</label>
                <input type="checkbox" name="subjects[]" value="JAVA">JAVA
                <input type="checkbox" name="subjects[]" value="PHP">PHP
                <input type="checkbox" name="subjects[]" value="PYTHON">PYTHON
                <input type="checkbox" name="subjects[]" value="C++">C++

                <input type="submit" name="submit" value="submit">
            </form>
        </div>
    </div>

    <form id="searchForm"  method="GET">
        <input type="text" class="i1" name="search" id="searchInput" placeholder="Search..." value="<?php echo isset($_GET['search']) ? $_GET['search'] : ''; ?>">
        <button type="submit" class="b1">Search</button>
    </form>

  
    <div id="editForm" class="modal">
        <div class="modal-content">
            <span class="close">&times;</span>
            <form id="updateForm">
                <input type="hidden" id="editId">
                <label for="editFirstName">First Name:</label>
                <input type="text" id="editFirstName" name="fnm" required>
                <label for="editLastName">Last Name:</label>
                <input type="text" id="editLastName" name="lnm" required>
                <div class="gender-container">
                    <label class="radio-container">Male
                        <input type="radio" name="gender" value="male" id="editMale" required>
                        <span class="checkmark"></span>
                    </label>
                    <label class="radio-container">Female
                        <input type="radio" name="gender" value="female" id="editFemale" required>
                        <span class="checkmark"></span>
                    </label>
                </div>
                <label for="editAge">Age:</label>
                <input type="number" id="editAge" name="age" required>
                <label for="editState">State:</label>
                <select name="state" id="editState" required>
                    <option value="0">Select</option>
                    <option>Gujarat</option>
                    <option>Delhi</option>
                    <option>Maharashtra</option>
                </select>
                <label for="editCity">City:</label>
                <select name="city" id="editCity" required>
                    <option value="0">Select</option>
                    <option>Junagadh</option>
                    <option>Rajkot</option>
                    <option>Baroda</option>
                </select>
                
                <input type="submit" value="Update">
            </form>
        </div>
    </div>


    <div class="card-body">
        <table class="table" id="table">
            <thead>
                <tr>
                    <th scope="col">id</th>
                    <th scope="col">Firstname</th>
                    <th scope="col">Lastname</th>
                    <th scope="col">Gender</th>
                    <th scope="col">Age</th>
                    <th scope="col">State</th>
                    <th scope="col">City</th>
                    <th scope="col">Subjects</th>
                </tr>
            </thead>
            <tbody>
            <?php
             
                if ($result->num_rows > 0) {
                    while($row = $result->fetch_assoc()) {
                        echo "<tr data-id='" . $row["id"]. "'>
                        <td>" . $row["id"]. "</td>
                        <td>" . $row["fnm"]. "</td>
                        <td>" . $row["lnm"]. "</td>
                        <td>" . $row["gender"]. "</td>
                        <td>" . $row["age"]. "</td>
                        <td>" . $row["state"]. "</td>
                        <td>" . $row["city"]. "</td>
                         <td>" . $row["subjects"]. "</td>
                        <td>
                            <button class='edtbtn'>Edit</button>
                            <button class='dbtn'>Delete</button>
                        </td>
                        </tr>";
                    }
                } else {
                    echo "<tr><td colspan='8'>No records found</td></tr>";
                }
                ?>
            </tbody>
        </table>
        
    </div>
    <ul class="pagination">
        <?php
        for ($page = 1; $page <= $total_pages; $page++) {
            echo '<li><a href="index.php?page=' . $page . '">' . $page . '</a></li>';
        }
        ?>
    <script src="https://code.jquery.com/jquery-3.7.1.min.js"></script>
    <script>
        document.addEventListener('DOMContentLoaded', (event) => {
            const openFormBtn = document.getElementById('openFormBtn');
            const popupForm = document.getElementById('popupForm');
            const closeBtns = document.querySelectorAll('.close');

            openFormBtn.addEventListener('click', () => {
                popupForm.style.display = 'block';
            });

            closeBtns.forEach(btn => {
                btn.addEventListener('click', () => {
                    btn.closest('.modal').style.display = 'none';
                });
            });

            window.addEventListener('click', (event) => {
                if (event.target == popupForm || event.target == editForm) {
                    event.target.style.display = 'none';
                }
            });

            
            function fetchRecords() {
                $.ajax({
                    url: 'fetch.php',
                    type: 'GET',
                    dataType: 'json',
                    data: { search: search },
                    success: function(data) {
                        const html = $(data).find('#table tbody').html();
                        $('#table tbody').empty();

                        data.forEach(function(student) 
                        {
                           $('#table tbody').append('<tr data-id="' + student.id + '"><td>' + student.id + '</td><td>' + student.fnm + '</td><td>' + student.lnm + '</td><td>' + student.gender + '</td><td>' + student.age + '</td><td>' + student.state + '</td><td>' + student.city + '</td><td>' +student.subjects+'</td><td><button class="edtbtn">Edit</button><button class="dbtn">Delete</button></td></tr>');
                                    
                        });

                        $('.edtbtn').click(function() {
                            const row = $(this).closest('tr');
                            const id = row.data('id');
                            const fnm = row.find('td:eq(1)').text();
                            const lnm = row.find('td:eq(2)').text();
                            const gender = row.find('td:eq(3)').text();
                            const age = row.find('td:eq(4)').text();
                            const state = row.find('td:eq(5)').text();
                            const city = row.find('td:eq(6)').text();

                            $('#editId').val(id);
                            $('#editFirstName').val(fnm);
                            $('#editLastName').val(lnm);
                            gender === 'male' ? $('#editMale').prop('checked', true) : $('#editFemale').prop('checked', true);
                            $('#editAge').val(age);
                            $('#editState').val(state);
                            $('#editCity').val(city);

                            $('#editForm').css('display', 'block');
                        });

                        $('.dbtn').click(function() {
                            const id = $(this).closest('tr').data('id');
                            if(confirm('Are You Sure ?')){
                            $.ajax({
                                url: 'delete.php',
                                type: 'POST',
                                data: { id: id },
                                success: function(response) {
                                    fetchRecords();
                                },
                                error: function(jqXHR, textStatus, errorThrown) {
                                    console.log('Error: ' + textStatus + ' - ' + errorThrown);
                                }
                            
                            });
                            }
                        }); 
                    },
                    error: function(jqXHR, textStatus, errorThrown) {
                        console.log('Error: ' + textStatus + ' - ' + errorThrown);
                    }
                });
            }

            fetchRecords();

            $('#updateForm').submit(function(e) {
                e.preventDefault();
                const id = $('#editId').val();
                const fnm = $('#editFirstName').val();
                const lnm = $('#editLastName').val();
                const gender = $('input[name="gender"]:checked').val();
                const age = $('#editAge').val();
                const state = $('#editState').val();
                const city = $('#editCity').val();
                // const subjects = [];
                // $('input[name="subjects[]"]:checked').each(function() {
                //     subjects.push($(this).val());
                // });

                $.ajax({
                    url: 'update.php',
                    type: 'POST',
                    data: { id: id, fnm: fnm, lnm: lnm, gender: gender, age: age, state: state, city: city},
                    success: function(response) {
                        $('#editForm').css('display', 'none');
                        fetchRecords();
                    },
                    error: function(jqXHR, textStatus, errorThrown) {
                        console.log('Error: ' + textStatus + ' - ' + errorThrown);
                    }
                });
            });
        });


        $(document).ready(function(){
          
            $.ajax({
                url: 'fetch_states.php',
                method: 'GET',
                success: function(data){
                    $('#state').html(data);
                }
            });

            $('#state').change(function(){
                var sid = $(this).val();
                if(sid != ''){
                    $.ajax({
                        url: 'fetch_cities.php',
                        method: 'POST',
                        data: {sid: sid},
                        success: function(data){
                            $('#city').html(data);
                        }
                    });
                } else {
                    $('#city').html('<option value="">Select City</option>');
                }
            });
        });
    </script>
</body>
</html>
