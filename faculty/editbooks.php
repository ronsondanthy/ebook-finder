<?php
session_start();

//if the faculty is logged in
if(isset($_SESSION['user_id']) && isset($_SESSION['user_email']))
{
    if(!isset($_GET['id'])) 
    {
        header("Location: facultydashboard.php");
        exit;
    }
    $id=$_GET['id'];
    //Including books/Authors/Category functions and Database Connection file
    include "../connection.php";
    include "../facultyphp/facultydashboardFunctions.php";

    $book=get_book($conn,$id);
    $authors=get_all_authors($conn);
    $courses=get_all_courses($conn);
    $branches=get_all_branches($conn);
    $getbranches=get_branches($conn);
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Edit/Update Books</title>
    <!-- bootstrap 5 CDN-->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-1BmE4kWBq78iYhFldvKuhfTAU6auU8tT94WrHftjDbrCEXSU1oBoqyl2QvZ6jIW3" crossorigin="anonymous">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.3/css/all.min.css" />
    <script src="https://cdnjs.cloudflare.com/ajax/libs/twitter-bootstrap/4.5.2/css/bootstrap.css"></script>
    <script src="https://cdn.datatables.net/1.13.2/css/dataTables.bootstrap4.min.css"></script>
    <link rel="stylesheet" href="../assets/admindashboard.css">
    <!-- bootstrap 5 Js bundle CDN-->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-ka7Sk0Gln4gmtz2MlQnikT1wXgYsOg+OMhuP+IlRH9sENBO0LRn5q+8nbTov4+1p" crossorigin="anonymous"></script>
    <script src="https://code.jquery.com/jquery-3.5.1.js"></script>
</head>
<body>
    <!-- Add Author Modal -->
    <?php
        include("addauthor.php");
    ?>
    <!-- End Author Modal -->
    <!-- changepassword Modal -->
    <?php
        include("changepassword.php");
    ?>
    <!-- End changepassword Modal -->
    <div class="d-flex" id="wrapper">
        <!-- Sidebar -->
        <div class="bg-white" id="sidebar-wrapper">
            <div class="sidebar-heading text-center py-4 primary-text fs-4 fw-bold text-uppercase border-bottom">
                <a href="https://manipal.edu/mit.html" target="_blank"><img src="../img/new logo manipal black.png" alt="MAHE" title="Manipal University" class="manipal-logo"></a>
            </div>
                <div class="list-group list-group-flush my-3">
                    <a href="facultydashboard.php" class="list-group-item list-group-item-action bg-transparent second-text active"><i
                            class="fas fa-tachometer-alt me-2"></i>Dashboard</a>
                    <button type="button" class="btn bg-transparent second-text fw-bold list-group-item list-group-item-action shadow-none" data-bs-toggle="modal" data-bs-target="#addauthor">
                            <i class="fas fa-paperclip me-2"></i>Add Author</button>
                    <a href="addbooks.php" class="list-group-item list-group-item-action bg-transparent second-text fw-bold"><i
                            class="fa fa-book me-2"></i>Add Books</a>
                    <a href="facultyprofile.php" class="list-group-item list-group-item-action bg-transparent second-text fw-bold"><i
                            class="fas fa-user me-2" data-toggle="modal"></i>My Profile</a>
                    <button type="button" class="btn bg-transparent second-text fw-bold list-group-item list-group-item-action shadow-none" data-bs-toggle="modal" data-bs-target="#changepassword">
                            <i class="fa fa-key me-2"></i>Change Password</button>
                    <a href="facultylogout.php" class="list-group-item list-group-item-action bg-transparent text-danger fw-bold"><i
                            class="fas fa-power-off me-2"></i>Logout</a>
                </div>
        </div>
        <!-- Sidebar Ends-->
        <!-- Header-->
        <div id="page-content-wrapper">
            <nav class="navbar navbar-expand-lg navbar-dark py-4 px-4">
                <div class="d-flex align-items-center">
                    <i class="fas fa-align-left dashboard-text fs-4 me-3" id="menu-toggle"></i>
                    <a href="admindashboard.php" class="text-decoration-none"><h2 class="fs-2 m-0 dashboard-text">Dashboard</h2></a>
                </div>
                <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
                <span class="navbar-toggler-icon"></span>
              </button>
              <div class="collapse navbar-collapse" id="navbarSupportedContent">
                    <ul class="navbar-nav ms-auto mb-2 mb-lg-0 align-items-center">
                        <a class="nav-link fw-bold dashboard-text" href="facultyprofile.php">
                            <i class="fas fa-user me-2 dashboard-text"></i><span class="text-light fw-bold">Hello!! <?php echo $_SESSION['user_name2'];?></span>
                        </a>
                    </ul>
                </div>
            </nav>
            <!-- Header Ends-->
            <hr class="bg-white mt-3">
            <!--Dashboard Containers-->
            <div class="row">
                <div class="mx-auto col-10 col-md-8 col-lg-6 mb-5">
                    <form action="../facultyphp/updatebook.php" method="post" enctype="multipart/form-data" class="shadow bg-light p-4 rounded mt-3" style="width: 90%; max-width: 50rem;">
                        <h1 class="text-center pb-3 display-4 fs-3 fw-bold">Edit/Update Books</h1>
                        <?php if (isset($_GET['error'])){ ?>
                            <div class="alert alert-danger" role="alert">
                                <?=htmlspecialchars($_GET['error']);?>
                            </div>
                        <?php } ?>
                        <?php if (isset($_GET['success'])){ ?>
                            <div class="alert alert-success" role="alert">
                                <?=htmlspecialchars($_GET['success']);?>
                            </div>
                        <?php } ?>
                        <?php
                        ?>
                        <div class="form-group mt-3">
                            <label for="btitle">Book Title <span style="color: red;">*</span></label>
                            <input type="text" value="<?=$book['id']?>" hidden id="book_id" name="book_id">
                            <input type="text" value="<?=$book['title']?>" class="form-control shadow-none" id="btitle" name="btitle" placeholder="Enter Title of the book">
                        </div>
                        <div class="form-group mt-3">
                            <label for="bdescription">Book Description <span style="color: red;">*</span></label>
                            <textarea class="form-control shadow-none" rows="3" id="bdescription" name="bdescription" placeholder="Enter description of Book"><?=$book['description']?></textarea>
                        </div>
                        <div class="form-group mt-3">
                            <label for="book_author">Select Author <span style="color: red;">*</span></label>
                            <select name="book_author" id="book_author" name="book_author" class="form-control shadow-none">
                                <option value="0">--- Select Author ---</option>
                                <?php
                                    if($authors==0)
                                    {
                                        #Nothing
                                    }
                                    foreach ($authors as $author)
                                    {
                                        if($book['author_id']==$author['author_id'])
                                        {
                                    ?>
                                        <option selected value="<?php echo $author['author_id']?>">
                                            <?=$author['author_name']?>
                                        </option>
                                    <?php 
                                        }
                                        else
                                        {
                                    ?>
                                        <option value="<?php echo $author['author_id']?>">
                                            <?=$author['author_name']?>
                                        </option>  
                                    <?php }
                                    }?>
                            </select>
                        </div>
                        <div class="form-group mt-3">
                            <label for="book_courses">Select Course <span style="color: red;">*</span></label>
                            <select id="book_courses" name="book_courses" class="form-control shadow-none">
                                <option  value="0">--- Select Course ---</option>
                                <?php
                                    foreach ($courses as $course)
                                    {
                                        if($book['course_id']==$course['course_id'])
                                        {
                                ?>
                                    <option selected value="<?php echo $course['course_id']?>">
                                        <?=$course['course_name']?>
                                    </option>
                                <?php   }
                                        else
                                        {
                                ?>
                                    <option value="<?php echo $course['course_id']?>">
                                        <?=$course['course_name']?>
                                    </option>
                                <?php
                                        }
                                    }
                                ?>
                            </select>
                        </div>
                        <div class="form-group mt-3">
                            <label for="book_branches">Select Branch <span style="color: red;">*</span></label>
                            <select id="book_branches" name="book_branches" class="form-control shadow-none">
                                <option value="">--- Select Branch ---</option>
                            </select>
                        </div>
                        <div class="form-group mt-3">
                            <label for="sem">Semester <span style="color: red;">*</span></label>
                            <input type="number" min="1" max="8" value="<?=$book['semester']?>" class="form-control shadow-none" id="sem" name="sem" placeholder="Enter semester (1-8)">
                        </div>
                        <div class="form-group mt-3">
                            <label for="book_cover">Book Cover <span style="color: red;">*</span></label>
                            <input type="file" id="book_cover" name="book_cover" class="form-control shadow-none" name="book_cover">
                            <input type="text" value="<?=$book['cover']?>" hidden id="current_cover" name="current_cover">
                            <a href="../img/uploads/cover/<?=$book['cover']?>" target="_blank" class="text-decoration-none link-primary">Click here to view Current Cover</a><br>
                            <small class="text-warning">Image type: .png, .jpg & .jpeg</small>
                        </div>
                        <div class="form-group mt-3">
                            <label for="book_file">Book File <span style="color: red;">*</span></label>
                            <input type="file" id="book_file" name="book_file" class="form-control shadow-none" name="book_file">
                            <input type="text" value="<?=$book['file']?>" hidden id="current_file" name="current_file">
                            <a href="../img/uploads/files/<?=$book['file']?>" target="_blank" class="text-decoration-none link-primary">Click here to view Current File</a><br>
                            <small class="text-warning">File type: .pdf, .docx & .pptx</small>
                        </div>
                        <div class="form-group mt-5 modal-footer justify-content-center">
                            <table>
                                <tr>
                                    <td class="pe-5"><button type="submit" class="btn btn-outline-primary shadow-none">Update Book</button></td>
                                    <td class="ps-5"><a href="facultydashboard.php" class="btn btn-outline-dark shadow-none">Back to Dashboard</a></td>
                                </tr>
                            </table>
                        </div>
                    </form>
                </div>
            </div> <!--Dashboard Container Ends-->
        </div><!--Page Content Wrapper Ends-->
    </div>       
    <script src="https://code.jquery.com/jquery-3.6.3.min.js" integrity="sha256-pvPw+upLPUjgMXY0G+8O0xUf+/Im1MZjXxxgOcBQBXU=" crossorigin="anonymous"></script>      
    <script>
        /** Transition of Admin Left Navigation Menu**/
        var el = document.getElementById("wrapper");
        var toggleButton = document.getElementById("menu-toggle");

        toggleButton.onclick = function () {
            el.classList.toggle("toggled");
        };
        $('#book_courses').on('change',function(){
            var course_name=this.value;
            $.ajax({
                url: "../facultyphp/branches.php",
                type: "POST",
                data: { course_id:course_name },
                success:function(result){
                    $('#book_branches').html(result);
                }
            });
        });
    </script>
</body>
</html>
<?php
}
else
{
    header("location: ../faculty/facultylogin.php");
    exit();
}
?>