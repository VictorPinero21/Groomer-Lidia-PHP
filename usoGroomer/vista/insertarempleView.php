<div class="centro" >
        <section style="height:400px;overflow-y:scroll; align:center">
            <form action="<?php echo $this->url("departamento", "crearemple"); ?>" method="post">
                <p>* Número de empleado: <input type="text" name="emp_no" required />          
                </p>
                <p>* Apellido: <input type="text" name="apellido"  required >
                </p>
                <p>* Oficio: <input type="text" name="oficio"  required >
                </p>
                <p>Director: 
                    <select name="dir" >
                        <option value=""></option>
                        <?php
                        foreach ($listajefes as $emp) {
                            echo ' <option value="' . $emp->getEmp_no() .
                            '">' . $emp->getEmp_no() . '--' .
                            $emp->getApellido() . '</option>';
                        }
                        ?>
                    </select>

                </p>             
                <p>Fecha de alta (yyyy/mm/dd): <input type="text" name="fecha_alt"/></p>
                <p>Salario: <input type="text"  name="salario" />   </p>
                <p>Comisión: <input type="text"  name="comision" />     </p>
                <p>* Departamento: 
                    <select name="dept_no" required="required">
                        <?php
                        foreach ($listadeps as $dep) {
                            echo '<option value="' . $dep->getDept_no() . '">' . $dep->getDept_no() . '--' .
                            $dep->getDnombre() . '</option>';
                        }
                        ?>

                    </select>
                </p> 
                <p> <input type="submit" value="Insertar empleado." /> </p>
            </form>
        </section>
        <form action="<?php echo $this->url("departamento", "index"); ?>" method="post">
            <input type="submit" value="Volver al inicio." />
        </form>
        <footer>
            <hr/>
            Ejemplo PHP - POO MVC -<?php echo date("Y"); ?>
        </footer>
</div>