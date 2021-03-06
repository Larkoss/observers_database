<?php
session_start();
// Get the DB connection info from the session
$serverName = $_SESSION["serverName"];
$connectionOptions = $_SESSION["connectionOptions"];
?>

<html>

<head>
    <title>Authenticated User</title>
    <link rel="icon" href="https://i.imgur.com/70ln1bX.png">
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <link href="https://fonts.googleapis.com/css?family=Lato:300,400,700&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/font-awesome/4.7.0/css/font-awesome.min.css">
    <link rel="stylesheet" href="css/style.css">
    <style>
        .divShow {
            display: none;
        }
    </style>
</head>

<body class="img js-fullheight" style="background-image: url(https://images.saymedia-content.com/.image/t_share/MTc4NzM1OTc4MzE0MzQzOTM1/how-to-create-cool-website-backgrounds-the-ultimate-guide.png);">
    <section class="ftco-section">
        <div class="container">
            <div class="row justify-content-center">
                <div class="col-md-6 col-lg-4">
                    <div class="login-wrap p-0">

                        <?php
                        if (isset($_SESSION["User ID"]) && isset($_SESSION["Privilages"])) {
                            $UserID = $_SESSION["User ID"];
                            $Privilages = $_SESSION["Privilages"];
                            //echo ("<hr>User ID: " . $UserID . "<br>Privilages: " . $Privilages);
                        } else {
                            session_unset();
                            session_destroy();
                            echo "You are not authorised! Redirecting you to the home page<br/>";
                            die('<meta http-equiv="refresh" content="3; url=index.php" />');
                            //header('Location: index.php');
                            //die();
                        }
                        ?>
                        <?php if ($Privilages == "1") : ?>
                            <hr>
                            <h2>Logged in as Observer Admin</h2>

                            <!-- VIEW TABLES -->
                            <hr>
                            <form action="queryShowTable.php" method="post">
                                <h3>0 View Every Table</h3>
                                <h4>Parameters:</h4>
                                <label for="action">Table</label>
                                <div class="form-group"><select id="action" name="action">
                                        <option value="" selected>Select table...</option>
                                        <option value="T1-Company">T1-Company</option>
                                        <option value="T1-User">T1-User</option>
                                        <option value="T1-Question">T1-Question</option>
                                        <option value="T1-Questionnaire">T1-Questionnaire</option>
                                        <option value="T1-Question Questionnaire Pairs">T1-Questionnaire Questionnaire Pairs</option>
                                    </select></div>
                                <input type="submit" name="Query Show Table" class="form-control btn btn-primary submit px-3" value="QUERY SHOW TABLE">
                            </form>

			  <!-- Show Questionnaire Log -->
                            <hr>
                            <form action="queryShowQuestionnaireLog.php" method="post">
                                <h3>Show Questionnaire Log</h3>
				<div class="form-group"><input class="form-control" type="text" name="user_id" placeholder="user_id"></div>
                                <div class="form-group"><input class="form-control" type="text" name="qn_id" placeholder="qn_id"></div>
                                <input type="submit" name="Query Show Questionnaire Log" class="form-control btn btn-primary submit px-3" value="QUERY SHOW QUESTIONNAIRE LOG">
                            </form>


                            <!--Query 1-->
                            <hr>
                            <form action="query1.php" method="post">
                                <h3>1 (Add Company Admin with Company)</h3>
                                <h4>Parameter:</h4>
                                <div class="form-group"><input type="text" name="IDCard" placeholder="ID Card" class="form-control"></div>
                                <div class="form-group">
                                    <input type="text" name="name" placeholder="Admin Name" class="form-control">
                                    Birth Date <input type="date" name="bday" class="form-control">
                                </div>
                                <div class="form-group">Sex
                                    <select id="sex" name="sex">
                                        <option value="M">M</option>
                                        <option value="F">F</option>
                                    </select>
                                </div>

                                <div class="form-group"><input type="text" name="position" placeholder="Position" class="form-control"></div>
                                <div class="form-group"><input type="text" name="username" placeholder="Username" class="form-control"></div>
                                <div class="form-group"><input type="password" name="password" placeholder="Password" class="form-control"></div>
                                <div class="form-group"><input type="text" name="manager_id" placeholder="Manager ID" class="form-control"></div>
                                <div class="form-group"><input type="text" name="company_reg_num" placeholder="Company Registration Number" class="form-control"></div>
                                <div class="form-group"><input type="text" name="company_brand_name" placeholder="Company Brand Name" class="form-control"></div>
                                <div class="form-group"><input type="submit" name="Query 1" class="form-control btn btn-primary submit px-3" value="Query 1"></div>
                            </form>

                            <!--Query 2a-->
                            <script>
                                function showHideQuery2a(value) {
                                    if (value == "") {
                                        document.getElementById("q2a_insert").style.display = "none";
                                        document.getElementById("q2a_show").style.display = "none";
                                    }
                                    if (value == "insert" || value == "update") {
                                        document.getElementById("q2a_insert").style.display = "block";
                                        document.getElementById("q2a_show").style.display = "block";
                                    }
                                    if (value == "show") {
                                        document.getElementById("q2a_insert").style.display = "none";
                                        document.getElementById("q2a_show").style.display = "block";
                                    }
                                }
                            </script>


                            <hr>
                            <form action="query2a.php" method="post">
                                <h3>2A (Insert/Update/View Company)</h3>
                                <h4>Parameter:</h4>
                                <label for="action">Action</label>
                                <div class="form-group"><select id="action" name="action" class="form-control" onchange="showHideQuery2a(this.value);">
                                        <option value="" selected>Select function...</option>
                                        <option value="insert">Insert</option>
                                        <option value="update">Update</option>
                                        <option value="show">Show</option>
                                    </select></div>
                                <div id="q2a_show" class="divShow">
                                    <div class="form-group"><input type="text" class="form-control" name="company_id" placeholder="Registration Number"></div>
                                </div>
                                <div id="q2a_insert" class="divShow">
                                    <div class="form-group"><input type="text" class="form-control" name="brand_name" placeholder="Brand Name"></div>
                                    <div class="form-group"><input type="date" class="form-control" name="new_date" placeholder="Induction Date"></div>
                                </div>

                                <input type="submit" name="Query 2a" value="QUERY 2A" class="form-control btn btn-primary submit px-3">
                            </form>

                            <!--Query 2b-->
                            <script>
                                function showHideQuery2b(value) {
                                    if (value == "") {
                                        document.getElementById("q2b_insert").style.display = "none";
                                        document.getElementById("q2b_show").style.display = "none";
                                    }
                                    if (value == "insert" || value == "update") {
                                        document.getElementById("q2b_insert").style.display = "block";
                                        document.getElementById("q2b_show").style.display = "block";
                                    }
                                    if (value == "show") {
                                        document.getElementById("q2b_insert").style.display = "none";
                                        document.getElementById("q2b_show").style.display = "block";
                                    }
                                }
                            </script>

                            <hr>
                            <form action="query2b.php" method="post">
                                <h3>2B (Insert/Update/View Admin)</h3>
                                <h4>Parameter:</h4>
                                <label for="action">Action</label>
                                <div class="form-group"><select id="action" class="form-control" name="action" class="default" onchange="showHideQuery2b(this.value);">
                                        <option value="" selected>Select function...</option>
                                        <option value="insert">Insert</option>
                                        <option value="update">Update</option>
                                        <option value="show">Show</option>
                                    </select></div>
                               
                                <div id="q2b_show" class="divShow">
                                    <div class="form-group"><input type="text" name="username" class="form-control" placeholder="Username"></div>
                                </div>
                                <div id="q2b_insert" class="divShow">
				    <div class="form-group"><input type="text" name="IDCard" placeholder="ID Card" class="form-control"></div>
                                    <div class="form-group"><input type="text" name="name" class="form-control" placeholder="Name"></div>
                                    <div class="form-group">
                                        Birth Date<input type="date" name="bday" class="form-control" placeholder="Birth Date">
                                        Sex<select id="sex" name="sex" class="form-control">
                                            <option value="M">M</option>
                                            <option value="F">F</option>
                                        </select>
                                    </div>
                                    <div class="form-group"><input type="text" name="position" class="form-control" placeholder="Position"></div>
                                    <div class="form-group"><input type="password" name="password" class="form-control" placeholder="Password"></div>
                                    <div class="form-group"><input type="text" name="manager_id" class="form-control" placeholder="Manager ID"></div>
                                    <div class="form-group"><input type="text" name="company_id" class="form-control" placeholder="Company ID"></div>
                                </div>
                                <input type="submit" name="Query 2b" value="QUERY 2B" class="form-control btn btn-primary submit px-3">
                            </form>

                        <?php else : ?>
                            <?php if ($Privilages == "2") : ?>
                                <hr>
                                <h2>Logged in as Company Admin</h2>
                                <!--Query 3-->
                                <hr>
                                <form action="query3.php" method="post">
                                    <h3>3 (Add Simple User)</h3>
                                    <h4>Parameter:</h4>
                                    <div class="form-group"><input type="text" name="idcard" placeholder="ID Card" class="form-control"></div>
                                    <input type="text" name="name" placeholder="Name" class="form-control">
                                    <div class="form-group">
                                        Birth Date<input type="date" name="bday" class="form-control" placeholder="Birth Date">
                                        Sex<select id="sex" name="sex" class="form-control">
                                            <option value="M">M</option>
                                            <option value="F">F</option>
                                        </select>
                                    </div>
                                    <div class="form-group"><input type="text" name="position" class="form-control" placeholder="Position"></div>
                                    <div class="form-group"><input type="text" name="username" class="form-control" placeholder="Username"></div>
                                    <div class="form-group"><input type="password" name="password" class="form-control" placeholder="Password"></div>
                                    <div class="form-group"><input type="text" name="manager_id" class="form-control" placeholder="Manager ID"></div>
                                    <div class="form-group"><input type="submit" name="Query 3" class="form-control btn btn-primary submit px-3" value="QUERY 3">
                                </form>

                                <!--Query 4-->
                                <script>
                                    function showHideQuery4(value) {
                                        if (value == "") {
                                            document.getElementById("q4_insert").style.display = "none";
                                            document.getElementById("q4_show").style.display = "none";
                                        }
                                        if (value == "insert" || value == "update") {
                                            document.getElementById("q4_insert").style.display = "block";
                                            document.getElementById("q4_show").style.display = "block";
                                        }
                                        if (value == "show") {
                                            document.getElementById("q4_insert").style.display = "none";
                                            document.getElementById("q4_show").style.display = "block";
                                        }
                                    }
                                </script>

                                <hr>
                                <form action="query4.php" method="post">
                                    <h3>4 (Insert/Update/View User)</h3>
                                    <h4>Parameters:</h4>
                                    <label for="action">Action</label>
                                    <div class="form-group"><select id="action" class="form-control" name="action" class="default" onchange="showHideQuery4(this.value);">
                                            <option value="" selected>Select function...</option>
                                            <option value="insert">Insert</option>
                                            <option value="update">Update</option>
                                            <option value="show">Show</option>
                                        </select></div>
                                    <div id="q4_show" class="divShow">
                                        <div class="form-group"><input class="form-control" type="text" name="username" placeholder="Username"></div>
                                    </div>
                                    <div id="q4_insert" class="divShow">
                                        <div class="form-group"><input type="text" name="IDCard" placeholder="ID Card" class="form-control"></div>
                                        <div class="form-group"><input class="form-control" type="text" name="name" placeholder="Name"></div>
                                        <div class="form-group">
                                            Birth Date<input type="date" name="bday" class="form-control" placeholder="Birth Date">
                                            Sex<select id="sex" name="sex" class="form-control">
                                                <option value="M">M</option>
                                                <option value="F">F</option>
                                            </select>
                                        </div>
                                        <div class="form-group"><input class="form-control" type="text" name="position" placeholder="Position"></div>
                                        <div class="form-group"><input class="form-control" type="password" name="password" placeholder="Password"></div>
                                        <div class="form-group"><input class="form-control" type="text" name="manager_id" placeholder="Manager ID"></div>
                                    </div>
                                    <input type="submit" name="Query 4" class="form-control btn btn-primary submit px-3" value="QUERY 4">
                                </form>



                            <?php else : ?>
                                <hr>
                                <h2>Logged in as Simple User</h2>
                            <?php endif; ?>
                            <!--Utilities -->
                            <hr>
                            <form action="queryShowQuestions.php" method="post">
                                <h3>Extra1 (Show Questions)</h3>
                                <input type="submit" name="Query Show Questions" class="form-control btnnn btnnn-primary submit px-3" value="Show Company's Questions">
                            </form>

                            <form action="queryShowQuestionDetails.php" method="post">
                                <h3>Extra 2 (Show Question Details)</h3>
                                <div class="form-group"><input class="form-control" type="text" name="question_id" placeholder="Question ID"></div>
                                <input type="submit" name="queryShowQuestionDetails" class="form-control btnnn btnnn-primary submit px-3" value="Show Question's Details">
                            </form>

                            <hr>
                            <form action="queryShowQuestionnaires.php" method="post">
                                <h3>Extra 3 (Show Questionnaires)</h3>
                                <input type="submit" name="Query Show Questionnaires" class="form-control btnnn btnnn-primary submit px-3" value="Show Company's Questionnaires">
                            </form>

                            <hr>
                            <form action="queryShowUsers.php" method="post">
                                <h3>Extra 4 (Show users)</h3>
                                <input type="submit" name="Query Show Users" class="form-control btnnn btnnn-primary submit px-3" value="Show Company's Users">
                            </form>

                            <!-- Query 5 -->
                            <script>
                                function showHideQuery5(value) {
                                    if (value == "") {
                                        document.getElementById("q5_insert").style.display = "none";
                                        document.getElementById("q5_delete").style.display = "none";
                                    }
                                    if (value == "insert") {
                                        document.getElementById("q5_insert").style.display = "block";
                                        document.getElementById("q5_delete").style.display = "none";
                                    }
                                    if (value == "update") {
                                        document.getElementById("q5_insert").style.display = "block";
                                        document.getElementById("q5_delete").style.display = "block";
                                    }
                                    if (value == "delete") {
                                        document.getElementById("q5_insert").style.display = "none";
                                        document.getElementById("q5_delete").style.display = "block";
                                    }
                                }
                            </script>

                            <script>
                                function showHideQuery5b(value) {
                                    if (value == "") {
                                        document.getElementById("Free Text").style.display = "none";
                                        document.getElementById("Multiple Choice").style.display = "none";
                                        document.getElementById("Arithmetic").style.display = "none";
                                    }
                                    if (value == "Free Text") {
                                        document.getElementById("Free Text").style.display = "block";
                                        document.getElementById("Multiple Choice").style.display = "none";
                                        document.getElementById("Arithmetic").style.display = "none";
                                    }
                                    if (value == "Multiple Choice") {
                                        document.getElementById("Free Text").style.display = "none";
                                        document.getElementById("Multiple Choice").style.display = "block";
                                        document.getElementById("Arithmetic").style.display = "none";
                                    }
                                    if (value == "Arithmetic") {
                                        document.getElementById("Free Text").style.display = "none";
                                        document.getElementById("Multiple Choice").style.display = "none";
                                        document.getElementById("Arithmetic").style.display = "block";
                                    }
                                }
                            </script>

                            <hr>
                            <form action="query5.php" method="post">
                                <h3>5 (Insert/Update/Delete Question)</h3>
                                <h4>Parameter:</h4>
                                <div class="form-group">Action <select id="action" name="action" class="form-control" onchange="showHideQuery5(this.value);">
                                        <option value="" selected>Select function...</option>
                                        <option value="insert">Insert</option>
                                        <option value="update">Update</option>
                                        <option value="delete">Delete</option>
                                    </select></div>
                                <div id="q5_delete" class="divShow">
                                    <div class="form-group"><input class="form-control" type="text" name="question_id" placeholder="Question ID"></div>
                                </div>
                                <div id="q5_insert" class="divShow">
                                    <div class="form-group"><input class="form-control" type="text" name="code" placeholder="Question Code"></div>
                                    <div class="form-group"><input class="form-control" type="text" name="description" placeholder="Description"></div>
                                    <div class="form-group"><input class="form-control" type="text" name="text" placeholder="Text"></div>
                                    <div class="form-group">Type <select class="default" id="type" name="type" onchange="showHideQuery5b(this.value);">
                                            <option value="" selected>Select question...</option>
                                            <option value="Free Text">Free Text</option>
                                            <option value="Multiple Choice">Multiple Choice</option>
                                            <option value="Arithmetic">Arithmetic</option>
                                        </select></div>
                                    <div id="Free Text" class="divShow">
                                        <div class="form-group"><input class="form-control" type="text" name="restriction" placeholder="Restriction"></div>
                                    </div>
                                    <div id="Multiple Choice" class="divShow">
                                        <div class="form-group"><input class="form-control" type="text" name="selectable_amount" placeholder="Selectable Amount"></div>
                                    </div>
                                    <div id="Arithmetic" class="divShow">
                                        <div class="form-group"><input class="form-control" type="text" name="min" placeholder="Min"></div>
                                        <div class="form-group"><input class="form-control" type="text" name="max" placeholder="Max"></div>
                                    </div>
                                </div>
                                <br><input type="submit" name="Query 5" class="form-control btn btn-primary submit px-3" value="QUERY 5">
                            </form>


                            <!--Query Insert Answer Mult Choice-->
                            <hr>
                            <form action="queryInsertAnswerMultChoice.php" method="post">
                                <h3>5A (Insert Multiple Choice's Answer)</h3>
                                <div class="form-group"><input class="form-control" type="text" name="question_id" placeholder="Question ID"></div>
                                <div class="form-group"><input class="form-control" type="text" name="answer" placeholder="Answer"></div>
                                <input type="submit" name="QueryInsertAnswerMultChoice" class="form-control btn btn-primary submit px-3" value="Insert Answer Mult Choice">
                            </form>

                            <!--Query Edit Answer Mult Choice-->
                            <form action="queryEditAnswerMultChoice.php" method="post">
                                <h3>5B (Edit Multiple Choice's Answer)</h3>
                                <div class="form-group"><input class="form-control" type="text" name="question_id" placeholder="Question ID"></div>
                                <div class="form-group"><input class="form-control" type="text" name="answer" placeholder="Answer"></div>
                                <div class="form-group"><input class="form-control" type="text" name="new_answer" placeholder="New Answer"></div>
                                <input type="submit" name="QueryEditAnswerMultChoice" class="form-control btn btn-primary submit px-3" value="Edit Answer Mult Choice">
                            </form>

                            <!--Query Delete Answer Mult Choice-->
                            <hr>
                            <form action="queryDeleteAnswerMultChoice.php" method="post">
                                <h3>5C (Remove Answer Multiple Choice)</h3>
                                <div class="form-group"><input class="form-control" type="text" name="question_id" placeholder="Question ID"></div>
                                <div class="form-group"><input class="form-control" type="text" name="answer" placeholder="Answer"></div>
                                <input type="submit" name="QueryDeleteAnswerMultChoice" class="form-control btn btn-primary submit px-3" value="Delete Answer Mult Choice">
                            </form>

                            <!--Query Show Answer Mult Choice-->
                            <form action="queryShowAnswerMultChoice.php" method="post">
                                <h3>5D (Show Answer Multiple Choice)</h3>
                                <div class="form-group"><input class="form-control" type="text" name="question_id" placeholder="Question ID"></div>
                                <input type="submit" name="QueryShowAnswerMultChoice" class="form-control btn btn-primary submit px-3" value="Show Answer Mult Choice">
                            </form>

                            <!--Query 6a-->
                            <hr>
                            <form action="query6a.php" method="post">
                                <h3>6A (Create New Questionnaire)</h3>
                                <div class="form-group"><input class="form-control" type="text" name="title" placeholder="Title"></div>
                                <input type="submit" name="Query 6a" class="form-control btn btn-primary submit px-3" value="QUERY 6A">
                            </form>

                            <!--Query 6b-->
                            <hr>
                            <form action="query6b.php" method="post">
                                <h3>6B (View Questionnaire's Questions)</h3>
                                <div class="form-group"><input class="form-control" type="text" name="title" placeholder="Title"></div>
                                <input type="submit" name="Query 6b" class="form-control btn btn-primary submit px-3" value="QUERY 6B">
                            </form>

                            <!--Query 6c-->
                            <hr>
                            <form action="query6c.php" method="post">
                                <h3>6C (Add Question to Questionnaire)</h3>
                                <div class="form-group"><input class="form-control" type="text" name="qn_id" placeholder="Questionnaire ID"></div>
                                <div class="form-group"><input class="form-control" type="text" name="q_id" placeholder="Question ID"></div>
                                <input type="submit" name="Query 6b" class="form-control btn btn-primary submit px-3" value="QUERY 6C">
                            </form>

                            <!--Query 6d-->
                            <hr>
                            <form action="query6d.php" method="post">
                                <h3>6D (Remove Question to Questionnaire)</h3>
                                <div class="form-group"><input class="form-control" type="text" name="qn_id" placeholder="Questionnaire ID"></div>
                                <div class="form-group"><input class="form-control" type="text" name="q_id" placeholder="Question ID"></div>
                                <input type="submit" name="Query 6d" class="form-control btn btn-primary submit px-3" value="QUERY 6D">
                            </form>

                            <!--Query 6e-->
                            <hr>
                            <form action="query6e.php" method="post">
                                <h3>6E (Change Questionnaire's status)</h3>
                                <div class="form-group"><input class="form-control" type="text" name="qn_id" placeholder="Questionnaire ID"></div>
                                <input type="submit" name="Query 6E" class="form-control btn btn-primary submit px-3" value="QUERY 6E">
                            </form>

                            <!--Query 6f-->
                            <hr>
                            <form action="query6f.php" method="post">
                                <h3>6F (Clone Questionnaire)</h3>
                                <div class="form-group"><input class="form-control" type="text" name="qn_id" placeholder="Questionnaire ID"></div>
                                <input type="submit" name="Query 6F" class="form-control btn btn-primary submit px-3" value="QUERY 6F">
                            </form>

                            <!--Query 7-->
                            <hr>
                            <form action="query7.php" method="post">
                                <h3>7 (Company's Questionnaires)</h3>
                                <input type="submit" name="Query 7" class="form-control btn btn-primary submit px-3" value="QUERY 7">
                            </form>

                            <!--Query 8-->
                            <hr>
                            <form action="query8.php" method="post">
                                <h3>8 (Most Popular Questions)</h3>
                                <input type="submit" name="Query 8" class="form-control btn btn-primary submit px-3" value="QUERY 8">
                            </form>

                            <!--Query 9-->
                            <hr>
                            <form action="query9.php" method="post">
                                <h3>9 (All Questionnaires)</h3>
                                <input type="submit" name="Query 9" class="form-control btn btn-primary submit px-3" value="QUERY 9">
                            </form>

                            <!--Query 10-->
                            <hr>
                            <form action="query10.php" method="post">
                                <h3>10 (Average Question per Questionnaire)</h3>
                                <input type="submit" name="Query 10" class="form-control btn btn-primary submit px-3" value="QUERY 10">
                            </form>

                            <!--Query 11-->
                            <hr>
                            <form action="query11.php" method="post">
                                <h3>11 (Above Avergage [Questions per Questionnaire ratio] Questionnaires)</h3>
                                <input type="submit" name="Query 11" class="form-control btn btn-primary submit px-3" value="QUERY 11">
                            </form>

                            <!--Query 12-->
                            <hr>
                            <form action="query12.php" method="post">
                                <h3>12 (Smallest Questionnaire/Questionnaires)</h3>
                                <input type="submit" name="Query 12" class="form-control btn btn-primary submit px-3" value="QUERY 12">
                            </form>

                            <!--Query 13-->
                            <hr>
                            <form action="query13.php" method="post">
                                <h3>13 (Questionnaires with exact same Questions)</h3>
                                <input type="submit" name="Query 13" class="form-control btn btn-primary submit px-3" value="QUERY 13">
                            </form>

                            <!--Query 14-->
                            <hr>
                            <form action="query14.php" method="post">
                                <h3>14 (Questionaires which have at least the Questions of selected Questionnaire)</h3>
                                <div class="form-group"><input class="form-control" type="text" name="qn_id" placeholder="Questionnaire ID"></div>
                                <input type="submit" name="Query 14" class="form-control btn btn-primary submit px-3" value="QUERY 14">
                            </form>


                            <!--Query 15-->
                            <hr>
                            <form action="query15.php" method="post">
                                <h3>15 (k Least Used Questions)</h3>
                                <div class="form-group"><input class="form-control" type="text" name="k_min" placeholder="Number k"></div>
                                <input type="submit" name="Query 15" class="form-control btn btn-primary submit px-3" value="QUERY 15">
                            </form>

                            <!--Query 16-->
                            <hr>
                            <form action="query16.php" method="post">
                                <h3>16 (Questions in every Questionnaire)</h3>
                                <input type="submit" name="Query 16" class="form-control btn btn-primary submit px-3" value="QUERY 16">
                            </form>

                            <!--Query 17a-->
                            <hr>
                            <form action="query17a.php" method="post">
                                <h3>17 (Find New Versions)</h3>
                                <div class="form-group"><input class="form-control" type="text" name="qn_id" placeholder="Questionnaire ID"></div>
                                <input type="submit" name="Query 17a" class="form-control btn btn-primary submit px-3" value="QUERY 17a">
                            </form>
					
				<!--Query 17b-->
                            <hr>
                            <form action="query17b.php" method="post">
                                <h3>17 (Find Question Count of Children)</h3>
                                <div class="form-group"><input class="form-control" type="text" name="qn_id" placeholder="Questionnaire ID"></div>
                                <input type="submit" name="Query 17b" class="form-control btn btn-primary submit px-3" value="QUERY 17b">
                            </form>

                        <?php endif; ?>


                        <hr>
                        <form method="post" action="logout.php">
                            <button type="submit" name="disconnect" class="form-control btnn btnn-primary submit px-3">Disconnect</button>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </section>




</body>

</html>
