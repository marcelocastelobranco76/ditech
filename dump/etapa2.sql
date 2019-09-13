SELECT deps.dept_name AS Departamento,
	   CONCAT(emps.first_name, " ", emps.last_name) AS Nome,
       DATEDIFF(IFNULL(depEmps.to_date, CURDATE()), depEmps.from_date) AS "Dias trabalhados"
FROM employees AS emps
LEFT JOIN dept_emp AS depEmps ON emps.emp_no = depEmps.emp_no
LEFT JOIN departments AS deps ON depEmps.dept_no = deps.dept_no
ORDER BY DATEDIFF(IFNULL(depEmps.to_date, CURDATE()), depEmps.from_date) DESC
LIMIT 10

