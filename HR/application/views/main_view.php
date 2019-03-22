<script src="/HR/js/employeeDeleteConfirm.js"></script>
<table class="table table-striped table-light">
      <thead class="thead-dark">
            <tr>
                  <th>ID</th>
                  <th>Mitarbeiter</th>
                  <th>Personalien</th>
                  <th>Arbeit</th>
                  <th>Pass-Angaben</th>
                  <th>Kinder</th>
                  <th>G17</th>
                  <th>HHM</th>
            </tr>
      </thead>
      <tbody>
      <?php $counter=1?>
            <?php foreach ($this->list as $employee): ?>
            <tr>
                  <td class="category-id">
                        <div>
                              <?php print htmlentities($counter++);?>
                        </div>
                  </td>
                  <td class="category-personal border-right">
                        <div class="employee-main">
                              <div class="employee-name">
                                    <img class="employee-photo" src=<?php print htmlentities($employee->Photo);?>
                                          alt="">
                                    <div style="display:inline-block">
                                          <?php print htmlentities($employee->Name);?>
                                    </div>
                                    <div style="display:inline-block">
                                          <?php print htmlentities($employee->LastName);?>
                                    </div>
                              </div>

                               <div class="employee-controls">
                                    <form action="/HR/edit" method="post">
                                          <input type="hidden" name="idEmployee"
                                                value=<?php print htmlentities($employee->Id);?>>
                                          <input class="editButton" type="submit">
                                    </form>
                                    <form action="/HR/delete" method="post">
                                          <input type="hidden" name="idEmployee"
                                                value=<?php print htmlentities($employee->Id);?>>
                                          <input class="deleteButton" type="submit">
                                    </form>
                                    <form action="/HR/calendar" method="post">
                                    <input type="hidden" name="idEmployee"
                                                value=<?php print htmlentities($employee->Id);?>>
                                                <input class="vacationButton" type="submit">
                                    </form>
                              </div> 
                        </div>
                  </td>

                  <td class="category-personalData">
                        <table class="table table-sm table-hover table-bordered">
                              <tbody>
                                    <tr>
                                          <td>Geburtsdatum</td>
                                          <td><?php print htmlentities($employee->BirthDate);?></td>
                                    </tr>
                                    <tr>
                                          <td>Zivilstand</td>
                                          <td><?php print htmlentities($employee->CivilState);?></td>
                                    </tr>
                                    <tr>
                                          <td>Wohnadresse</td>
                                          <td><?php print htmlentities($employee->Address);?></td>
                                    </tr>
                                    <tr>
                                          <td>PLZ</td>
                                          <td><?php print htmlentities($employee->PLZ);?></td>
                                    </tr>
                                    <tr>
                                          <td>Ort</td>
                                          <td><?php print htmlentities($employee->Place);?></td>
                                    </tr>
                                    <tr>
                                          <td>Telephone</td>
                                          <td><?php print htmlentities($employee->Phone);?></td>
                                    </tr>
                              </tbody>
                        </table>
                  </td>

                  <td class="category-career">
                        <table class="table table-sm table-hover table-bordered">
                              <tbody>
                                    <tr>
                                          <td>Eintrittsdatum</td>
                                          <td><?php print htmlentities($employee->StartDate);?></td>
                                    </tr>
                                    <tr>
                                          <td>Anzahl Jahre bei G17</td>
                                          <td>1 Tag</td>
                                    </tr>
                                    <tr>
                                          <td>Position</td>
                                          <td><?php print htmlentities($employee->Position);?></td>
                                    </tr>
                                    <tr>
                                          <td>Lohn</td>
                                          <td><?php print htmlentities($employee->Salary);?></td>
                                    </tr>
                              </tbody>
                        </table>
                  </td>
                  <td class="category-passport">
                        <table class="table table-sm table-hover table-bordered">
                              <tbody>
                                    <tr>
                                          <td>Pass Name</td>
                                          <td><?php print htmlentities($employee->Pass_Name);?></td>
                                    </tr>
                                    <tr>
                                          <td>Pass Vorname</td>
                                          <td><?php print htmlentities($employee->Pass_LastName);?></td>
                                    </tr>
                                    <tr>
                                          <td>Passnummer</td>
                                          <td> <?php print htmlentities($employee->Pass_Number);?></td>
                                    </tr>
                                    <tr>
                                          <td>Gültigkeit</td>
                                          <td><?php print htmlentities($employee->Pass_Expired);?></td>
                                    </tr>
                              </tbody>
                        </table>
                  </td>

                  <td class="category-children">
                        <table class="table table-sm table-hover table-bordered">
                              <thead>
                  <th>Name</th>
                  <th>Vorname</th>
                  <th>Geburtstag</th>
                  </thead>
      <tbody>
            <?php foreach ($employee->Children as $child): {if(isset($child->Name))?>
            <tr>
                  <td>
                        <?php print htmlentities($child->ChildName);?>
                  </td>
                  <td>
                        <?php print htmlentities($child->ChildLastName);?>
                  </td>
                  <td>
                        <?php print htmlentities($child->ChildBirthday);?>
                  </td>
            </tr>
            <?php }endforeach;?>
      </tbody>
</table>
</td>

<td class="category-G17">
      <table class="table table-sm table-hover table-bordered">
            <tbody>
                  <tr>
                        <td> G17 E-Mail</td>
                  </tr>
                  <tr>
                        <td><?php print htmlentities($employee->G17_email);?></td>
                  </tr>
                  <tr>
                        <td>G17 Kürzel:</td>
                  </tr>
                  <tr>
                        <td><?php print htmlentities($employee->G17_initials);?></td>
                  </tr>
            </tbody>
      </table>
</td>

<td class="category-HHM">
      <table class="table table-sm table-hover table-bordered">
            <tbody>
                  <tr>
                        <td>HHM E-Mail</td>
                  </tr>
                  <tr>
                        <td> <?php print htmlentities($employee->HHM_email);?></td>
                  </tr>
                  <tr>
                        <td>HHM Kürzel</td>
                  </tr>
                  <tr>
                        <td><?php print htmlentities($employee->HHM_initials);?></td>
                  </tr>
            </tbody>
      </table>
</td>
<?php endforeach;?>

</tbody>
</table>