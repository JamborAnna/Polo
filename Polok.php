<form method="POST">
	<input type="hidden" name="action" value="cmd_insert_user_form">
	<input type="submit" value="Felvétel űrlap megjelenítése">
</form>	
		


<?php

echo "<pre>"; var_dump($_POST); echo "</pre>";

if (isset($_POST["action"]) and $_POST["action"]=="cmd_update_polo"){
	$update_form = new adatbazis();
	$update_form->kapcsolodas();
	$update_form->update_form();
	$update_form->kapcsolatbontas();		
}
if (isset($_POST["action"]) and $_POST["action"]=="cmd_update_polo"){
	$update_user = new adatbazis();
	$update_user->kapcsolodas();
	$update_user->cmd_update_polo();
	$update_user->kapcsolatbontas();		
}
if (isset($_POST["action"]) and $_POST["action"]=="cmd_insert_user_form"){
	$insert = new adatbazis();
	$insert->kapcsolodas();
	$insert->insert_user_form();
	$insert->kapcsolatbontas();	
}
if (isset($_POST["action"]) and $_POST["action"]=="cmd_insert_user"){
	$insert = new adatbazis();
	$insert->kapcsolodas();
	$insert->insert_blog();
	$insert->kapcsolatbontas();	
}
if (isset($_POST["action"]) && $_POST["action"] == "cmd_delete")
{
    $delete = new Adatbazis();
	$delete->kapcsolodas();
	$delete->delete();
	$delete->kapcsolatbontas();	
}


$list = new Adatbazis();
$list->kapcsolodas();
$list->list();
$list->kapcsolatbontas();

class adatbazis{
	public	$servername = "localhost:3307";
	public	$username = "root";
	public	$password = "";
	public	$dbname = "polok";
	public $conn = NULL;
	public $sql = NULL;
	public $result = NULL;
	public $row = NULL;
	
	public function kapcsolodas(){

		// Create connection
		$this->conn = new mysqli($this->servername, $this->username, $this->password, $this->dbname);
		// Check connection
		if ($this->conn->connect_error) {
			die("Connection failed: " . $this->conn->connect_error);
		}	
		$this->conn->query("SET NAMES 'UTF8';");
	}
	public function insert_user_form(){
		?>
		<h1>Felvétel űrlap</h1>
		<form method="POST">
			Add meg a meretet: <br />
			<input type="int" name="imput_meret"><br />
			Add meg a mintát: <br />
			<input type="text" name="input_minta"><br />
			Add meg a gyártás dátumát: <br />
			<input type="date" name="imput_gyartas"><br />		
			Add meg van-e raktáro: <br />	
			<select name="input_raktaron">
				<option value='igen'>nincs</option>
				<option value='nem'>van</option>
			</select><br />	
			<input type="hidden" name="action" value="cmd_insert_user">
			<input type="submit" value="Felvétel">
		</form>			
		<?php
	}
	public function update_form(){
		//echo "Módosítandó sor: " . $_POST["input_id"] . "<br />";
		$this->sql = "SELECT 
					`id`, 
					`meret`, 
					`raktaron`, 
					`minta`, 
					`gyartas`, 
					 
				FROM 
					`polo`
				WHERE
					`id` = ". $_POST["input_id"].";
					";
		$this->result = $this->conn->query($this->sql);

		if ($this->result->num_rows > 0) {
			// output data of each row
			while($this->row = $this->result->fetch_assoc()) {
					//echo $this->row["id"] . ".: ";
					//echo $this->row["raktaron"];
					?>
					<h1>Módosítás űrlap</h1>
					<form method="POST">
						Add meg a meretét: <br />
						<input type="int" name="input_meret"
							value="<?php echo $this->row["meret"]; ?>"><br />
						Add meg a mintáját: <br />
						<input type="text" name="input_minta"
							value="<?php echo $this->row["minta"]; ?>"><br />		
						Add meg a gyártás dátumát: <br />
						<input type="date" name="input_gyartas"
							value="<?php echo $this->row["gyartas"]; ?>"><br />		
						Add meg van-e raktáro: <br />	
							<select name="input_raktaron">
							<option value='0'>nincs</option>
							<option value='1'>van</option>
						</select><br />	
						<!--
						Add meg a jogosultság: <br />	
						<select name="input_minta">
							<option value='user'>user</option>
							<option value='admin'>admin</option>
							<option value='moderator'>moderator</option>
						</select><br />	
						Add meg a aktivitást: <br />	
						<select name="input_gyartas">
							<option value='1'>Aktív</option>
							<option value='0' selected>Inaktív</option>
						</select><br />	
						-->
						<input type="hidden" name="input_id" 
							value="<?php echo  $this->row["id"]; ?>">
						<input type="hidden" name="action" value="cmd_update_polo">
						<input type="submit" value="Módosítás végrehajtása">
					</form>							
					<?php
			}
		} else {
			echo "0 results";
		}				

	}
			
			
			
 public function list()
    {
        $this->sql = "SELECT * FROM polo";
		$this->result = $this->conn->query($this->sql);
		if ($this->result->num_rows > 0)
		{
			while($this->row = $this->result->fetch_assoc())
			{ ?>
				<p style="display:inline;">
					<?php 
                    echo $this->row["meret"] . "\t";
                    ?>
                    <form method="POST" style="display:inline;">
                        <select name="input_keszleten" onchange="this.form.submit();"> <?php
                            if ($this->row["raktaron"] == 1)
                            { ?>
                                <option value='1' selected>Van</option>
                                <option value='0'>Nincs</option> <?php
                            }
                            else
                            { ?>
                                <option value='1' >Van</option>
                                <option value='0' selected>Nincs</option> <?php
                            } ?>
			            </select>
                        <input type="hidden" name="input_id" value="<?php echo $this->row["id"]; ?>">
                        
                    </form> <?php
					echo $this->row["minta"] . "\t";
                    echo "\t".$this->row["gyartas"];
                    ?>
					<form method='POST' style="display:inline;">
						<input type='hidden' name='action' value='cmd_update_form'>
						<input type='hidden' name='input_id' value='<?php echo $this->row["id"] ?>'>
						<input type='submit' value='Módosítás'>
					</form>
                    <form method='POST' style="display:inline;">
						<input type='hidden' name='action' value='cmd_delete'>
						<input type='hidden' name='input_id' value='<?php echo $this->row["id"] ?>'>
						<input type='submit' value='Törlés'>
					</form>
				</p> <?php
			}
		} 
		else 
		{
			echo "Még nincs felvéve póló az adatbázisba.";
		}
	}


	
	public function cmd_update_polo(){
		$this->sql = "UPDATE 
						polo
					  SET
						`meret`='".$_POST["input_meret"]."',
						`gyartas`='".$_POST["input_gyartas"]."', 
						`minta`='".$_POST["input_minta"]."',
						`raktaron`='".$_POST["input_raktaron"]."'
	
					  WHERE
					     `id` = ". $_POST["input_id"]."
							;";
		if($this->conn->query($this->sql)){
			echo "Sikeres adatmódosítás!<br />";
		} else {
			echo "Sikertelen adatmódosítás!<br />";
		}		
	}
	
	public function select_blog(){
		$this->sql = "SELECT 
					`id`, 
					`meret`, 
					`raktaron`, 
					`minta`, 
					`gyartas`
					 
				FROM 
					`polo`";
		$this->result = $this->conn->query($this->sql);

		if ($this->result->num_rows > 0) {
			// output data of each row
			while($this->row = $this->result->fetch_assoc()) {
				echo "<p>";
					echo $this->row["id"] . ".: ";
					echo $this->row["raktaron"];
					echo "<form method='POST'>";
						echo "<input type='hidden' name='action' value='cmd_update_polo'>";
						echo "<input type='hidden' name='input_id' value='".$this->row["id"]."'>";
						echo "<input type='submit' value='Módosítás'>";
					echo "</form>";
				echo "</p>";
			}
		} else {
			echo "0 results";
		}		
	}
	    public function delete()
    {
        $this->sql = "DELETE FROM polo WHERE id=".$_POST["input_id"];
        if ($this->conn->query($this->sql))
        {
            echo "Sikeres törlés! <br />";
        }
        else
        {
            echo "Sikertelen törlés! <br />";
        }
    }

	public function insert_blog(){
		$this->sql = "INSERT INTO 
						users
							(
							`id`, 
							`meret`,  
							`raktaron`, 
							`minta`, 
							`gyartas` 
							
							)
						VALUES
							(
							NULL,
							".$_POST["imput_meret"].",
							'".$_POST["input_minta"]."',
							'".$_POST["imput_gyartas"]."',
							".$_POST["input_raktaron"]."
							)
							";
							echo $this->sql;
		if($this->conn->query($this->sql)){
			echo "Sikeres adatfelvétel!<br />";
		} else {
			echo "Sikertelen adatfelvétel!<br />";
		}
	}
	public function kapcsolatbontas(){
		$this->conn->close();		
	}
}






?>