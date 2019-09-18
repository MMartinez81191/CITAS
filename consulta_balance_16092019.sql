
SELECT 
	COUNT(costo_consulta) numero_pacientes,
    0 AS numero,
    'Consultas' AS descripcion, 
    costo_consulta AS costo,
    (COUNT(costo_consulta) * costo_consulta) AS total
FROM citas 
WHERE  
	fecha = '2019-09-16' AND 
	id_tipo_cita != 2 AND 
	cobrado = 1 AND
	activo = 1
	GROUP BY costo_consulta
UNION
SELECT 
	COUNT(costo_consulta) numero_pacientes,
    0 AS numero,
    'Membresias' AS descripcion, 
    costo_consulta AS costo,
    (COUNT(costo_consulta) * costo_consulta) AS total 
FROM citas 
WHERE  
	fecha = '2019-09-16' AND 
	id_tipo_cita = 2 AND 
	cobrado = 1 AND
	activo = 1
	GROUP BY costo_consulta
UNION
SELECT 
	0 AS numero_pacientes,
	SUM(numero_carnets_vendidos) as numero,
    'Total Venta de carnets' AS descripcion,
    20 as costo ,
    (SUM(numero_carnets_vendidos) * 20) as total
FROM venta_carnets 
WHERE
	fecha = '2019-09-16' AND 
	activo = 1
UNION
SELECT 
	0 numero_pacientes,
    COUNT(importe) as numero,
    'Total gastos' AS descripcion, 
    count(importe) AS costo ,
    SUM(importe) AS total 
FROM gastos 
WHERE 
	fecha = '2019-09-16' AND 
	activo = 1
 
UNION
SELECT 
	0 AS numero_pacientes, 
	COUNT(importe) AS numero,
    'Total devoluciones' AS descripcion,
    count(importe) as costo,
    SUM(importe) AS total
FROM devoluciones
WHERE 
	activo = 1 AND
	fecha = '2019-09-16'



