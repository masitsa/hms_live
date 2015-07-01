<div class="row statistics">
    <div class="col-md-2 col-sm-12">
        <ul class="today-datas">
            <!-- List #1 -->
            <li class="overall-datas">
                <h5>Visit Breakdown</h5>
                <table class="table table-striped table-hover table-condensed">
                	<thead>
                    	<tr>
                        	<th>Type</th>
                            <th>Visits</th>
                        </tr>
                    </thead>
                    <tbody>
                        <tr>
                            <th>Staff</th>
                            <td><?php echo $staff;?></td>
                        </tr>
                        <tr>
                            <th>Students</th>
                            <td><?php echo $students;?></td>
                        </tr>
                        <tr>
                            <th>Insurance</th>
                            <td><?php echo $insurance;?></td>
                        </tr>
                        <tr>
                            <th>Other</th>
                            <td><?php echo $other;?></td>
                        </tr>
                        <tr>
                            <th>Unclosed visits</th>
                            <td><?php echo $unclosed_visits;?></td>
                        </tr>
                    </tbody>
                </table>
                <!-- Text -->
                <div class="datas-text">
                	Total Visits <span class="bold"><?php echo number_format(($total_patients + $unclosed_visits), 0);?></span>
                </div>
                
                <div class="clearfix"></div>
            </li>
        </ul>
    </div>
    
    <div class="col-md-10 col-sm-12">
        <ul class="today-datas">
            <li class="overall-datas">
                <div class="row">
                    <div class="col-md-3">
                        <h5>Revenue Type</h5>
                        <table class="table table-striped table-hover table-condensed">
                            <tbody>
                                <tr>
                                    <th>Payments</th>
                                    <td><?php echo number_format($total_payments, 2);?></td>
                                </tr>
                                <tr>
                                    <th>Debtors</th>
                                    <td><?php echo number_format(($total_services_revenue - $total_payments), 2);?></td>
                                </tr>
                                <tr>
                                    <th>Total</th>
                                    <td><?php echo number_format($total_services_revenue, 2);?></td>
                                </tr>
                            </tbody>
                        </table>
                        
                        <div class="clearfix"></div>
            		</div>
                    <!-- End Transaction Breakdown -->
                    
                    <?php 
					
					if($title != 'Debtors Report')
					{
					?>
                    <div class="col-md-3">
                        <h5>Cash Breakdown</h5>
                        <table class="table table-striped table-hover table-condensed">
                            <tbody>
								<?php
									echo 
									'
									<tr>
										<th>Cash</th>
										<td>'.number_format($total_cash, 2).'</td>
									</tr>
									<tr>
										<th>Cheque</th>
										<td>'.number_format($total_cheque, 2).'</td>
									</tr>
									<tr>
										<th>Mpesa</th>
										<td>'.number_format($total_mpesa, 2).'</td>
									</tr>
									<tr>
										<th>Total</th>
										<td>'.number_format($total_payments, 2).'</td>
									</tr>
									';
                                ?>
                            </tbody>
                        </table>
                    </div>
                    <!-- End Cash Breakdown -->
                    
                    <?php 
					}
					if($title != 'Cash Report')
					{
					?>
                    <div class="col-md-3">
                        <h5>Debtors Breakdown</h5>
                        <table class="table table-striped table-hover table-condensed">
                            <tbody>
                                <tr>
                                    <th>Students</th>
                                    <td><?php echo number_format($total_students_debt, 2);?></td>
                                </tr>
                                <tr>
                                    <th>Staff</th>
                                    <td><?php echo number_format(($total_staff_debt), 2);?></td>
                                </tr>
                                <tr>
                                    <th>Insurance</th>
                                    <td><?php echo number_format(($total_insurance_debt), 2);?></td>
                                </tr>
                                <tr>
                                    <th>Other</th>
                                    <td><?php echo number_format($total_other_debt, 2);?></td>
                                </tr>
                                <tr>
                                    <th>Total</th>
                                    <td><?php echo number_format(($total_services_revenue - $total_payments), 2);?></td>
                                </tr>
                            </tbody>
                        </table>
                        
                        <div class="clearfix"></div>
            		</div>
                    <!-- End debt Breakdown -->
                    <?php
					}
					?>
                    <div class="col-md-3">
                        <div class="datas-text pull-right">Total Revenue <span class="bold">
                            KSH <?php echo number_format($total_services_revenue, 2);?></span>
                        </div>
                    </div>
                </div>
            </li>
        </ul>
    </div>
</div>