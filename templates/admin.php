<?php 
    $args = array(
        'headers'     => array(["Accept" => "application/json"]),
    ); 

    $response = wp_remote_get("http://registration.jcity.com.ph/api/members/get", $args);
    $json = json_decode($response["body"], true);

    $data = [];
    $data = array_merge($data, $json["data"]);
    while($json["next_page_url"] != null)
    {
        $response = wp_remote_get($json["next_page_url"], $args);
        $json = json_decode($response["body"], true);
        $data = array_merge($data, $json["data"]);
    }
?>

<h1>Jcity Membership</h1>

<table id="membership_table" class="display">
    <thead>
        <tr>
            <th>Last Name</th>
            <th>First Name</th>
            <th>Middle Name</th>
            <th>Suffix</th>
            <th>Birthday</th>
            <th>Address</th>
            <th>City</th>
            <th>Email</th>
            <th>Mobile No</th>
            <th>Points</th>
            <th>Date Approved</th>
            <th>Actions</th>
        </tr>  
    </thead>
    <tbody>
    <?php foreach($data as $key => $member){?>
    <tr>
        <td><?php echo $member["lastName"]?></td>
        <td><?php echo $member["firstName"]?></td>
        <td><?php echo $member["middleName"]?></td>
        <td><?php echo $member["suffix"]?></td>
        <td><?php echo $member["birthday"]?></td>
        <td><?php echo $member["address"]?></td>
        <td><?php echo $member["city"]?></td>
        <td><?php echo $member["email"]?></td>
        <td><?php echo $member["mobileNumber"]?></td>
        <td><?php echo $member["points"]?></td>
        <td><?php echo $member["approved"]?></td>
        <td><button class="btn btn-approve" value="<?php echo $member["id"]?>">Approve</button></td>
    </tr>
    <?php }?>
    </tbody>
</table>

<?php 

wp_enqueue_script('jquery-3.1.1', plugins_url('../assets/js/jquery-3.3.1.min.js', __FILE__), -1); 

wp_enqueue_script('jquery_dataTables_script', plugins_url('../assets/js/jquery.dataTables.min.js', __FILE__));

wp_enqueue_style('jquery_dataTables_style', plugins_url('../assets/css/jquery.dataTables.min.css', __FILE__));

wp_enqueue_script('zro_script', plugins_url('../assets/js/zro_script.js', __FILE__)); 

?>