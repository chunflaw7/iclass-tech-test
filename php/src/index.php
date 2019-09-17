<link rel="stylesheet" type="text/css" href="style.css">
<?php
	// New Mysqli Connection
	$conn = mysqli_connect('mysql', 'root', 'verysecurerootpasswordiclassTECHtessolution12345672019docker', 'employees');
	
	$query = 'SELECT departments.dept_name AS dept_name,
		CONCAT(employees.first_name, " ", employees.last_name) AS name,
        employees.gender AS gender,
        salaries.salary AS salary,
		YEAR(CURRENT_TIMESTAMP) - YEAR(employees.hire_date) - (RIGHT(CURRENT_TIMESTAMP, 5) < RIGHT(employees.hire_date, 5)) as serve_for,
        COUNT(*) AS employees_count,
        SUM(salaries.salary) as employees_salary
		FROM dept_manager
		INNER JOIN employees ON dept_manager.emp_no = employees.emp_no
		INNER JOIN departments ON dept_manager.dept_no = departments.dept_no
        INNER JOIN dept_emp ON dept_manager.dept_no = dept_emp.dept_no
        INNER JOIN salaries ON dept_manager.emp_no = salaries.emp_no
        WHERE dept_manager.to_date > CURRENT_DATE AND dept_emp.to_date > CURRENT_DATE AND salaries.to_date > CURRENT_DATE
        GROUP BY dept_manager.dept_no, employees.emp_no, salaries.salary
        ORDER BY dept_manager.from_date';
	
	if (mysqli_connect_errno())
	{
	  echo "Failed to connect to MySQL: " . mysqli_connect_error();
	}
	
	$result = mysqli_query($conn, $query);
?>

<table width="100%" cellspacing="0">
	<thead>
		<th width="25%">Department</th>
		<th width="25%">Name</th>
		<th width="25%">Salary</th>
		<th width="25%">Served for</th>
	</thead>
	<tbody>
	<?php 
	$index = 0;
	while ($row = mysqli_fetch_array($result)) {
		$sex = "";
		$ctn = '<tr id="row-' . $index . '" class="sex-' . $row['gender'] . '">';
		$ctn .= '<td>' . $row['dept_name'] . '</td>';
		$ctn .= '<td>' . $row['name'] . '</td>';
		$ctn .= '<td align="right">' . $row['salary'] . '</td>';
		$ctn .= '<td align="right">'. $row['serve_for'] . ' Years</td>';
		$ctn .= '</tr>';
		$ctn .= '<span id="detail-' . $index . '" class="detail">' . $row['employees_count'] . ' Employees under this Manager<br/>';
		$ctn .= '$' . $row['employees_salary'] . ' spent on them totally</span>';
		echo $ctn;
		$index++;
	} ?>
	</tbody>
</table>
<script src="./script.js"></script>


	