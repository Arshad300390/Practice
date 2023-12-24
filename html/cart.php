<?php
include "connect.php";?>
<!DOCTYPE html>
<html>

<head>
    <title></title>
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <style>
    a:link {
        text-decoration: none;
    }

    a:hover {
        color: orange;
    }

    .searbk {
        width: 100%;
        background-color: #f1f1f1;
    }

    .searchbar {
        width: 100%;
        height: 38px;
    }

    .ptbi {
        background-color: #f1f1f1;
    }

    .dcp {
        padding: 2px 6px;
        width: 100%;
    }

    .switch {
        position: absolute;
        display: inline-block;
        width: 58px;
        height: 32px;
        margin-left: 400px;
        margin-top: -46px;
    }

    .switch input {
        opacity: 0;
        width: 0;
        height: 0;
    }

    .slider {
        position: absolute;
        cursor: pointer;
        top: 0;
        left: 0;
        right: 0;
        bottom: 0;
        background-color: #ccc;
        -webkit-transition: .4s;
        transition: .4s;
    }

    .slider:before {
        position: absolute;
        content: "";
        height: 26px;
        width: 26px;
        left: 4px;
        bottom: 4px;
        background-color: white;
        -webkit-transition: .4s;
        transition: .4s;
    }

    input:checked+.slider {
        background-color: #2196F3;
    }

    input:focus+.slider {
        box-shadow: 0 0 1px #2196F3;
    }

    input:checked+.slider:before {
        -webkit-transform: translateX(26px);
        -ms-transform: translateX(26px);
        transform: translateX(26px);
    }

    /* Rounded sliders */
    .slider.round {
        border-radius: 34px;
    }

    .slider.round:before {
        border-radius: 50%;
    }

    @media(max-width:991px) {
        .switch {
            margin-left: 194px;
        }
    }

    .drim {
        background-colo: dodgerblue;
    }

    .icon-container {
        width: 50px;
        height: 50px;
        position: relative;
    }

    .status-circle {
        width: 15px;
        height: 15px;
        border-radius: 50%;
        border: 2px solid white;
        margin-left: 66px;
        margin-top: -12px;
        position: absolute;
    }
    </style>
</head>

<body>
    <br><br>
    <div style="width:100%" class="container">
        <div class="card">
            <div class="card-header">
                <div class="col-lg-12">
                    <?php
$id = $_SESSION["buyer_id"];
$buyer_id = $_SESSION["buyer_id"];
$query = "select * from buyer where id = '$buyer_id'";
$result = mysqli_query($con, $query);

$row = mysqli_fetch_object($result);
$img = $row->pic;
$name = $row->name;
?>
                    <img class="mt-2" src="buyer-picture/<?=$img?>" width="60px" height="50px"
                        style="border-radius:6px;"><a href="#">
                        <h6 style="margin-top:-46px;
margin-left:62px;margin-bottom:30px;">
                            <span class="ml-2"><?=$name?></span>
                        </h6>
                    </a>
                </div>
            </div>

            <?php
$value = "";
if (isset($_GET["search"])) {
    $value = $_GET["search"];
}
?>
            <div class="searbk pt-4">
                <div class="col-lg-12">
                    <form action="http://localhost/tijaraflex/buyer.php?buyer-chat=buyer-chat">
                        <input type="hidden" name="buyer-chat" value="buyer-chat">
                        <input type="search text-center" name="search" value="<?=$value?>" class="dcp"
                            placeholder="Search Here">
                    </form>
                </div>
            </div>
            <div class="col-lg-12 ptbi">
                <?php
$value = "";
if (isset($_GET["search"])) {
    $value = $_GET["search"];
    $query = "select * from seller where name like '%$value%' ||  id  like '%$value%' ";
    $result = mysqli_query($con, $query);
} else {

    //
    $query3 = "select * from test_message where buyer_id = '4'";
    $result3 = mysqli_query($con, $query3);
    while ($row3 = mysqli_fetch_object($result3)) {
    }
    //

    $query = "select * from seller";
    $result = mysqli_query($con, $query);

    while ($row = mysqli_fetch_object($result)) {

        $query2 =
        "select * from test_message   where seller_id  =" .
        $row->id .
            "
&& buyer_id  ='$buyer_id' && comment  = '0' &&  sended = 'seller' ";
        $result2 = mysqli_query($con, $query2);
        ?>
                <div class="icon-container">
                    <img class="mt-3 ml-3" src="seller-picture/<?=$row->pic?>" width="60px" height="50px"
                        style="border-radius:6px;margin-bottom:-4px">
                    <?php if ($row->online == 1) {?>
                    <div class="status-circle" id="cass" style="background-color:green;">
                    </div>
                    <?php }?>
                </div>
                <a href="buyer.php?buyer-video-chat=buyer-video-chat
&seller=<?=base64_encode(base64_encode($row->id))?>">
                    <h6 style="margin-top:-34px;margin-left:92px;">
                        <?=$row->name?><span style="font-size:16px;background-color:none;color:red;
margin-left:3px;padding:1px 6px;border-radius:4px;
">
                            <?=mysqli_num_rows($result2) == 0
        ? ""
        : "( " . mysqli_num_rows($result2) . " )"?>

                        </span></h6>
                </a>
                <br>
                <?php
}
    ?>
                <br>


            </div>
        </div>
    </div>
</body>

</html>
<?php
}

?>