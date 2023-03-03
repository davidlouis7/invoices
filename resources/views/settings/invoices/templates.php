<script id="defaultTemplate" type="text/x-jsrender">
    <div class="preview-main client-preview">
        <div class="d" id="boxes">
            <div class="d-inner">
                <div class="row">
                    <div class="d-col-3">
                        <h1 class="d-fancy-title mb5">INVOICE</h1>
                        <p class="font-color-gray">Invoice ID #9CQ5X7</p>
                    </div>
                    <div class="d-col-1" style="padding-left: 10px !important">
                        <img src="<?php echo getLogoUrl() ?>"
                                                class="img-logo">
                    </div>
                </div>
                <div class="row">
                    <div class="d-col-2">
                        <div class="col-66">
                            <small style="font-size: 15px; margin-bottom: 3px"><b>From</b></small><br>
                            <p class="p-text mb-0">{{:companyName}}</p>
                            <p class="p-text mb-0">{{:companyAddress}}</p>
                            <p class="p-text mb-0">Mo: {{:companyPhone}}</p>
                        </div>
                    </div>
                    <div class="d-col-2">
                        <small class="from-font-size"><b>To</b></small><br>         
                        <p class="p-text mb-0">&ltClient Name&gt</p>
                        <p class="p-text mb-0">&ltClient Email&gt</p>
                        <p class="p-text mb-0">&ltClient Address&gt</p><br>
                    </div>
                </div>
                <div class="row">
                    <div class="w-95 text-right">
                        <p class="p-text mb-0"><b>Invoice Date: </b> 25th Nov, 2020 8:03 AM</p>
                        <p class="p-text mb-0"><b>Due Date: </b> 26th Nov, 2020</p>
                    </div>
                </div>
                <div class="table d-table">
                    <div class="d-table-tr" style="background:{{:invColor}};color: #fff;">
                        <div class="d-table-th in-w-1" style="border: 1px solid #ccc;padding: 8px">#</div>
                        <div class="d-table-th in-w-2" style="border: 1px solid #ccc;padding: 8px">Item</div>
                        <div class="d-table-th in-w-3" style="border: 1px solid #ccc;padding: 8px">Qty</div>
                        <div class="d-table-th in-w-4 text-right" style="border: 1px solid #ccc;padding: 8px">Amount</div>
                    </div>
                    <div class="d-table-body">
                        <div class="d-table-tr">
                            <div class="d-table-td in-w-1" style="border: 1px solid #ccc;padding: 8px"><span>1</span></div>
                            <div class="d-table-td in-w-2" style="border: 1px solid #ccc;padding: 8px">
                                <pre>Item 1</pre>
                            </div>
                            <div class="d-table-td in-w-3" style="border: 1px solid #ccc;padding: 8px">
                                1
                            </div>
                            <div class="d-table-td in-w-4 text-right" style="border: 1px solid #ccc;padding: 8px"><span ><?php echo getCurrencyAmount(100, true); ?></span></div>
                        </div>
                        <div class="d-table-tr">
                            <div class="d-table-td in-w-1" style="border: 1px solid #ccc;padding: 8px"><span>2</span></div>
                            <div class="d-table-td in-w-2" style="border: 1px solid #ccc;padding: 8px">
                                <pre>Item 2</pre>
                            </div>
                            <div class="d-table-td in-w-3" style="border: 1px solid #ccc;padding: 8px">
                                1
                            </div>
                            <div class="d-table-td in-w-4 text-right" style="border: 1px solid #ccc;padding: 8px"><span ><?php echo getCurrencyAmount(100, true); ?></span></div>
                        </div>
                        <div class="d-table-tr">
                            <div class="d-table-td in-w-1" style="border: 1px solid #ccc;padding: 8px"><span>3</span></div>
                            <div class="d-table-td in-w-2" style="border: 1px solid #ccc;padding: 8px">
                                <pre>Item 3</pre>
                            </div>
                            <div class="d-table-td in-w-3" style="border: 1px solid #ccc;padding: 8px">
                                1
                            </div>
                            <div class="d-table-td in-w-4 text-right" style="border: 1px solid #ccc;padding: 8px"><span ><?php echo getCurrencyAmount(100, true); ?></span></div>
                        </div>
                    </div>
                    <div class="d-table-footer">
                        <div class="d-table-controls"></div>
                        <div class="d-table-summary">
                            <div class="d-table-summary-item">
                                <div class="d-table-label"><strong >Amount:</strong></div>
                                <div class="d-table-value"><?php echo getCurrencyAmount(300, true); ?></div>
                            </div>
                            <div class="d-table-summary-item">
                                <div class="d-table-label"><strong >Discount:</strong></div>
                                <div class="d-table-value"><?php echo getCurrencyAmount(50, true); ?></div>
                            </div>
                            <div class="d-table-summary-item">
                                <div class="d-table-label"><strong >Tax:</strong></div>
                                <div class="d-table-value">0%</div>
                            </div>
                            <div class="d-table-summary-item">
                                <div class="d-table-label"><strong >Total:</strong></div>
                                <div class="d-table-value"><?php echo getCurrencyAmount(250, true); ?></div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="break-25"></div>
                 <div class="row">
                    <div class="d-col-3">
                        <h4 class="d-fancy-title mb5">Notes:</h1>
                        <p class="font-color-gray">
                        Paypal , Stripe & manual payment method accept.<br>
                        Net 10 – Payment due in 10 days from invoice date.<br>
                        Net 30 – Payment due in 30 days from invoice date.
                        </p>
                    </div>
                    <div class="d-col-3">
                        <h4 class="d-fancy-title mb5">Terms:</h1>
                        <p class="font-color-gray">Invoice payment terms ; 1% 10 Net 30, 1% discount if payment received within ten days otherwise payment 30 days after invoice date.</p>
                    </div>
                </div>
            </div>
        </div>
    </div>
</script>

<script id="newYorkTemplate" type="text/x-jsrender">
    <div class="preview-main client-preview">
        <div class="d" id="boxes">
            <div class="d-header">
                 <div class="ny-header-inner">
                      <div class="d-header-50">
                           <div class="d-header-brand">
                                <img src="<?php echo getLogoUrl() ?>" class="img-logo">
                           </div>
                           <div class="mt-3"></div>
                                <p class="p-text mb-0">{{:companyName}}</p>
                                <p class="p-text mb-0">{{:companyAddress}}</p>
                                <p class="p-text mb-0">Mo: {{:companyPhone}}</p>
                           </div>
                           <div class="d-header-50 d-right">
                                <div class="d-title">INVOICE</div>
                                     <table class="summary-table">
                                          <tbody>
                                              <tr>
                                                  <td><strong>Invoice ID:</strong></td>
                                                  <td>#9B5QX7</td>
                                              </tr>
                                              <tr>
                                                <td><strong>Invoice Date:</strong></td>
                                                <td>25th Nov, 2020 8:03 AM</td>
                                              </tr>
                                              <tr>
                                                <td><strong>Due Date:</strong></td>
                                                <td>25 Nov 2020</td>
                                              </tr>
                                            </tbody>
                                        </table>
                                    </div>
                                </div>
                           </div>
                           <div class="d-body">
                                <div class="d-bill-to">
                                    <strong class="to-font-size">To</strong>                                
                                        <p class="p-text mb-0">&ltClient Name&gt</p>
                                        <p class="p-text mb-0">&ltClient Email&gt</p>
                                        <p class="p-text mb-0">&ltClient Address&gt</p><br>
                                    <div class=table" width="100%">
                                         <div class="tu d-table-tr" style="background:{{:invColor}};color: white;padding: 0px 8px 0px 8px;">
                                            <div class="d-table-th in-w-1">#</div>
                                            <div class="d-table-th in-w-2">Item</div>
                                            <div class="d-table-th in-w-3">Qty</div>
                                            <div class="d-table-th in-w-4 text-right">Amount</div>
                                        </div>
                                        <div class="d-table-body">
                                            <div class="d-table-tr" style="border-bottom: 1px solid {{:invColor}};">
                                                <div class="d-table-td in-w-1"><span>1</span></div>
                                                <div class="d-table-td in-w-2">
                                                    <pre>Item 1</pre>
                                                </div>
                                                <div class="d-table-td in-w-3">
                                                    1
                                                </div>
                                                <div class="d-table-td in-w-4 text-right"><span ><?php echo getCurrencyAmount(100, true); ?></span></div>
                                            </div>
                                            <div class="d-table-tr" style="border-bottom: 1px solid {{:invColor}};">
                                                <div class="d-table-td in-w-1"><span>2</span></div>
                                                <div class="d-table-td in-w-2">
                                                    <pre>Item 2</pre>
                                                </div>
                                                <div class="d-table-td in-w-3">
                                                    1
                                                </div>
                                                <div class="d-table-td in-w-4 text-right"><span ><?php echo getCurrencyAmount(100, true); ?></span></div>
                                            </div>
                                            <div  class="d-table-tr" style="border-bottom: 1px solid {{:invColor}};">
                                                <div class="d-table-td in-w-1"><span>3</span></div>
                                                <div class="d-table-td in-w-2">
                                                    <pre>Item 3</pre>
                                                </div>
                                                <div class="d-table-td in-w-3">
                                                    1
                                                </div>
                                                <div class="d-table-td in-w-4 text-right"><span ><?php echo getCurrencyAmount(100, true); ?></span></div>
                                            </div>
                                        <div class="d-table-footer">
                                               <div class="d-table-controls"></div>
                                               <div class="d-table-summary">
                                                   <div class="d-table-summary-item">
                                                        <div class="tu d-table-label"><strong >Amount:</strong></div>
                                                        <div class="d-table-value"><?php echo getCurrencyAmount(300, true); ?></div>
                                                   </div>
                                                   <div class="d-table-summary-item" style="border-top: 1px solid {{:invColor}}; border-bottom: 1px solid {{:invColor}};">
                                                        <div class="tu d-table-label"><strong >Discount:</strong></div>
                                                        <div class="d-table-value"><?php echo getCurrencyAmount(50, true); ?></div>
                                                   </div>
                                                   <div class="d-table-summary-item">
                                                        <div class="tu d-table-label"><strong >Tax:</strong></div>
                                                        <div class="d-table-value">0%</div>
                                                   </div>
                                                   <div class="d-table-summary-item" style="border-top: 1px solid {{:invColor}};border-bottom: 1px solid {{:invColor}};">
                                                        <div class="tu d-table-label"><strong >Total:</strong></div>
                                                        <div class="d-table-value"><?php echo getCurrencyAmount(250, true); ?></div>
                                                   </div>
                                               </div>
                                        </div>
                                    </div>
                           </div>
                      </div>
                      <div class="break-25"></div>
                      <div class="row">
                            <div class="d-col-3">
                                <h4 class="d-fancy-title mb5">Notes:</h1>
                                <p class="font-color-gray">
                                Paypal , Stripe & manual payment method accept.<br>
                                Net 10 – Payment due in 10 days from invoice date.<br>
                                Net 30 – Payment due in 30 days from invoice date.
                                </p>
                            </div>
                            <div class="d-col-3">
                                <h4 class="d-fancy-title mb5">Terms:</h1>
                                <p class="font-color-gray">Invoice payment terms ; 1% 10 Net 30, 1% discount if payment received within ten days otherwise payment 30 days after invoice date.</p>
                            </div>
                      </div>
                      <br>
                 <p style="color:{{:invColor}}"><strong class="b">Regards:</strong></p>
                 <span>{{:companyName}}</span>
            </div>
        </div>
    </div>

</script>

<script id="torontoTemplate" type="type/x-jsrender">
    <div class="preview-main client-preview">
        <div class="d" id="boxes">
            <div class="d-inner">
                <div class="row" style="margin-right: 15px">
                    <div class="t-col-2">
                        <img src="<?php echo getLogoUrl() ?>" class="img-logo">
                    </div>
                    <div class="t-col-2 text-right">
                        <p class="p-text mb-0">{{:companyName}}</p>
                        <p class="p-text mb-0">{{:companyAddress}}</p>
                        <p class="p-text mb-0">Mo: {{:companyPhone}}</p>
                    </div>
                </div>
                <br>
                <div class="row" style="margin-right: 15px">
                    <div class="t-col-66">
                        <strong class="tu mb5 to-font-size" style="color:{{:invColor}}">To</strong>
                        <p class="p-text">
                            &ltClient Name&gt;<br>
                            &ltClient Email&gt;<br>
                            &ltClient Address&gt;
                        </p>
                    </div>
                    <div class="d-col-33">
                        <strong class="tu mb5" style="color:{{:invColor}};font-size: 18px">INVOICE</strong>
                        <table class="summary-table">
                            <tbody>
                            <tr>
                                <td class="tu"><strong>Invoice ID:</strong></td>
                                <td class="text-right">#84R41W</td>
                            </tr>
                            <tr>
                                <td class="tu"><strong>Invoice Date:</strong></td>
                                <td class="text-right">25th Nov, 2020 8:03 AM</td>
                            </tr>
                            <tr>
                                <td class="tu"><strong>Due Date:</strong></td>
                                <td class="text-right">26 Nov 2020</td>
                            </tr>
                            </tbody>
                        </table>
                    </div>
                </div>
                <div class="table d-table">
                        <div class="tu d-table-tr" style="color: {{:invColor}}; border-bottom: 1px solid {{:invColor}}; border-top: 1px solid {{:invColor}};">
                            <div class="d-table-th in-w-1">#</div>
                            <div class="d-table-th in-w-2">Item</div>
                            <div class="d-table-th in-w-3">Qty</div>
                            <div class="d-table-th in-w-4 text-right">Amount</div>
                        </div>
                        <div class="d-table-body">
                            <div class="d-table-tr" style="border-bottom: 1px solid {{:invColor}};">
                                <div class="d-table-td in-w-1"><span>1</span></div>
                                <div class="d-table-td in-w-2">
                                    <pre>Item 1</pre>
                                </div>
                                <div class="d-table-td in-w-3">
                                    1
                                </div>
                                <div class="d-table-td in-w-4 text-right"><span ><?php echo getCurrencyAmount(100, true); ?></span></div>
                            </div>
                            <div class="d-table-tr" style="border-bottom: 1px solid {{:invColor}};">
                                <div class="d-table-td in-w-1"><span>2</span></div>
                                <div class="d-table-td in-w-2">
                                    <pre>Item 2</pre>
                                </div>
                                <div class="d-table-td in-w-3">
                                    1
                                </div>
                                <div class="d-table-td in-w-4 text-right"><span ><?php echo getCurrencyAmount(100, true); ?></span></div>
                            </div>
                            <div class="d-table-tr" style="border-bottom: 1px solid {{:invColor}};">
                                <div class="d-table-td in-w-1"><span>3</span></div>
                                <div class="d-table-td in-w-2">
                                    <pre>Item 3</pre>
                                </div>
                                <div class="d-table-td in-w-3">
                                    1
                                </div>
                                <div class="d-table-td in-w-4 text-right"><span ><?php echo getCurrencyAmount(100, true); ?></span></div>
                            </div>
                        </div>
                        <div class="d-table-footer">
                            <div class="d-table-controls"></div>
                                <div class="d-table-summary">
                                   <div class="d-table-summary-item" border-top: 1px solid {{:invColor}}; border-bottom: 1px solid {{:invColor}};">
                                        <div class="tu d-table-label"><strong >Amount:</strong></div>
                                        <div class="d-table-value"><?php echo getCurrencyAmount(300, true); ?></div>
                                   </div>
                                   <div  class="d-table-summary-item" border-top: 1px solid {{:invColor}}; border-bottom: 1px solid {{:invColor}};">
                                        <div class="tu d-table-label"><strong >Discount:</strong></div>
                                        <div class="d-table-value"><?php echo getCurrencyAmount(50, true); ?></div>
                                   </div>
                                   <div  class="d-table-summary-item" border-top: 1px solid {{:invColor}}; border-bottom: 1px solid {{:invColor}};">
                                        <div class="tu d-table-label"><strong >Tax:</strong></div>
                                        <div class="d-table-value">0%</div>
                                   </div>
                                   <div class="d-table-summary-item" border-top: 1px solid {{:invColor}};>
                                        <div class="tu d-table-label"><strong >Total:</strong></div>
                                        <div class="d-table-value"><?php echo getCurrencyAmount(250, true); ?></div>
                                   </div>
                               </div>
                        </div>
                </div>
                <div class="break-25"></div>
                 <div class="row">
                            <div class="d-col-3">
                                <h4 class="d-fancy-title mb5">Notes:</h1>
                                <p class="font-color-gray">
                                Paypal , Stripe & manual payment method accept.<br>
                                Net 10 – Payment due in 10 days from invoice date.<br>
                                Net 30 – Payment due in 30 days from invoice date.
                                </p>
                            </div>
                            <div class="d-col-3">
                                <h4 class="d-fancy-title mb5">Terms:</h1>
                                <p class="font-color-gray">Invoice payment terms ; 1% 10 Net 30, 1% discount if payment received within ten days otherwise payment 30 days after invoice date.</p>
                            </div>
                      </div>
                      <br>
                <div class="d-header-50">
                    <p style="color:{{:invColor}}"><strong class="b">Regards:</strong></p>
                       <span>{{:companyName}}</span>
                </div>
            </div>
        </div>
    </div>





</script>

<script id="rioTemplate" type="type/x-jsrender">
    <div class="preview-main client-preview">
        <div class="d" id="boxes">
            <div class="d-inner">
                <div class="row">
                    <div class="r-col-3">
                        <h1 class="fancy-title tu mb5" style="color: {{:invColor}};font-size: 34px">INVOICE</h1>
                    </div>
                    <div class="r-col-1">
                        <img src="<?php echo getLogoUrl() ?>"
                                              class="img-logo">
                    </div>
                </div>
                <div class="break-50"></div>
                <div class="row" style="margin-right: 15px">
                    <div class="r-col-66">
                        <strong class="tu mb5 from-font-size" style="color: {{:invColor}};">From</strong>
                        <p class="p-text mb-0">{{:companyName}}</p>
                        <p class="p-text mb-0 w-75">{{:companyAddress}}</p>
                        <p class="p-text mb-0">Mo: {{:companyPhone}}</p>
                    </div>
                    <div class="r-col-33">
                        <table class="summary-table">
                            <tbody>
                            <tr>
                                <td class="tu fwb" style="color: {{:invColor}};">Invoice ID:</td>
                                <td class="text-right">#45C2R1</td>
                            </tr>
                            <tr>
                                <td class="tu fwb" style="color: {{:invColor}};">Invoice Date:</td>
                                <td class="text-right">25th Nov, 2020 8:03 AM</td>
                            </tr>
                            <tr>
                                <td class="tu fwb" style="color: {{:invColor}};">Due Date:</td>
                                <td class="text-right">26 Nov 2020</td>
                            </tr>
                            </tbody>
                        </table>
                    </div>
                </div>
                <br>
                <div class="row">
                    <div class="r-col-3">
                        <div class="col-80">
                        <strong class="tu mb5 to-font-size" style="color: {{:invColor}};">To</strong>
                            <p class="p-text">
                                &ltClient Name&gt;<br>
                                &ltClient Email&gt;<br>
                                &ltClient Address&gt;
                            </p>
                        </div>
                    </div>
                </div>
                <div class="table d-table">
                    <div class="tu d-table-tr" style="border-top: 1px solid {{:invColor}};">
                        <div class="d-table-th in-w-1">#</div>
                        <div class="d-table-th in-w-2">Item</div>
                        <div class="d-table-th in-w-3">Qty</div>
                        <div class="d-table-th in-w-4 text-right">Amount</div>
                    </div>
                    <div class="d-table-body">
                        <div class="d-table-tr" style="border-top: 1px solid {{:invColor}};">
                            <div class="d-table-td in-w-1"><span>1</span></div>
                            <div class="d-table-td in-w-2">
                                <pre>Item 1</pre>
                            </div>
                            <div class="d-table-td in-w-3">
                                1
                            </div>
                            <div class="d-table-td in-w-4 text-right"><span ><?php echo getCurrencyAmount(100, true); ?></span></div>
                        </div>
                        <div class="d-table-tr" style="border-top: 1px solid {{:invColor}};">
                            <div class="d-table-td in-w-1"><span>2</span></div>
                            <div class="d-table-td in-w-2">
                                <pre>Item 2</pre>
                            </div>
                            <div class="d-table-td in-w-3">
                                1
                            </div>
                            <div class="d-table-td in-w-4 text-right"><span ><?php echo getCurrencyAmount(100, true); ?></span></div>
                        </div>
                        <div class="d-table-tr" style="border-top: 1px solid {{:invColor}}; border-bottom: 1px solid {{:invColor}};">
                            <div class="d-table-td in-w-1"><span>3</span></div>
                            <div class="d-table-td in-w-2">
                                <pre>Item 3</pre>
                            </div>
                            <div class="d-table-td in-w-3">
                                1
                            </div>
                            <div class="d-table-td in-w-4 text-right"><span ><?php echo getCurrencyAmount(100, true); ?></span></div>
                        </div>
                    </div>
                    <div class="d-table-footer">
                        <div class="d-table-controls"></div>
                            <div class="d-table-summary">
                               <div class="d-table-summary-item">
                                    <div class="tu d-table-label"><strong >Amount:</strong></div>
                                    <div class="d-table-value"><?php echo getCurrencyAmount(300, true); ?></div>
                               </div>
                               <div class="d-table-summary-item" style="border-top: 1px solid {{:invColor}};">
                                    <div class="tu d-table-label"><strong >Discount:</strong></div>
                                    <div class="d-table-value"><?php echo getCurrencyAmount(50, true); ?></div>
                               </div>
                               <div class="d-table-summary-item" style="border-top: 1px solid {{:invColor}};">
                                    <div class="tu d-table-label"><strong >Tax:</strong></div>
                                    <div class="d-table-value">0%</div>
                               </div>
                               <div class="d-table-summary-item" style="border-top: 1px solid {{:invColor}}; border-bottom: 1px solid {{:invColor}};">
                                    <div class="tu d-table-label"><strong >Total:</strong></div>
                                    <div class="d-table-value"><?php echo getCurrencyAmount(250, true); ?></div>
                               </div>
                            </div>
                        </div>
                    </div>
                    <div class="break-25"></div>
                     <div class="row">
                            <div class="d-col-3">
                                <h4 class="d-fancy-title mb5">Notes:</h1>
                                <p class="font-color-gray">
                                Paypal , Stripe & manual payment method accept.<br>
                                Net 10 – Payment due in 10 days from invoice date.<br>
                                Net 30 – Payment due in 30 days from invoice date.
                                </p>
                            </div>
                            <div class="d-col-3">
                                <h4 class="d-fancy-title mb5">Terms:</h1>
                                <p class="font-color-gray">Invoice payment terms ; 1% 10 Net 30, 1% discount if payment received within ten days otherwise payment 30 days after invoice date.</p>
                            </div>
                      </div>
                      <br>
                    <div class="d-header-50">
                        <p style="color:{{:invColor}}"><strong class="b">Regards:</strong></p>
                        <span>{{:companyName}}</span>
                </div>
            </div>
        </div>
    </div>





</script>

<script id="londonTemplate" type="type/x-jsrender">
    <div class="preview-main client-preview">
        <div class="d" id="boxes">
            <div class="d-inner">
                <div class="row">
                    <div class="l-col-3">
                        <h1 class="l-fancy-title tu mb5" style="color:{{:invColor}}">INVOICE</h1>
                        <p class="p-text mb-0">{{:companyName}}</p>
                        <p class="p-text mb-0 w-75">{{:companyAddress}}</p>
                        <p class="p-text mb-0">Mo: {{:companyPhone}}</p>
                    </div>
                    <div class="l-col-1">
                        <img src="<?php echo getLogoUrl() ?>"
                             class="img-logo">
                    </div>
                </div>
                <br>
                <div class="row" style="margin-right: 15px">
                    <div class="l-col-66">
                        <strong class="tu mb5 to-font-size" style="color:{{:invColor}}">To</strong>
                        <p class="p-text">
                            &ltClient Name&gt;<br>
                            &ltClient Email&gt;<br>
                            &ltClient Address&gt;
                        </p>
                    </div>
                    <div class="l-col-33">
                        <table class="summary-table">
                            <tbody>
                            <tr>
                                <td class="tu fwb" style="color:{{:invColor}}">Invoice ID:</td>
                                <td class="text-right">#2E5TS3</td>
                            </tr>
                            <tr>
                                <td class="tu fwb" style="color:{{:invColor}}">Invoice Date:</td>
                                <td class="text-right">25th Nov, 2020 8:03 AM</td>
                            </tr>
                            <tr>
                                <td class="tu fwb" style="color:{{:invColor}}">Due Date:</td>
                                <td class="text-right">26 Nov 2020</td>
                            </tr>
                            </tbody>
                        </table>
                    </div>
                </div>
                <div class="table d-table">
                    <div class="tu d-table-tr" style="border-top: 2px solid {{:invColor}}; border-bottom: 2px solid {{:invColor}};">
                        <div class="d-table-th in-w-1">#</div>
                        <div class="d-table-th in-w-2">Item</div>
                        <div class="d-table-th in-w-3">Qty</div>
                        <div class="d-table-th in-w-4 text-right">Amount</div>
                    </div>
                    <div class="d-table-body">
                        <div class="d-table-tr">
                            <div class="d-table-td in-w-1"><span>1</span></div>
                            <div class="d-table-td in-w-2">
                                <pre>Item 1</pre>
                            </div>
                            <div class="d-table-td in-w-3">
                                1
                            </div>
                            <div class="d-table-td in-w-4 text-right"><span ><?php echo getCurrencyAmount(100, true); ?></span></div>
                        </div>
                        <div class="d-table-tr">
                            <div class="d-table-td in-w-1"><span>2</span></div>
                            <div class="d-table-td in-w-2">
                                <pre>Item 2</pre>
                            </div>
                            <div class="d-table-td in-w-3">
                                1
                            </div>
                            <div class="d-table-td in-w-4 text-right"><span ><?php echo getCurrencyAmount(100, true); ?></span></div>
                        </div>
                        <div class="d-table-tr" style="border-bottom: 1px solid {{:invColor}};">
                            <div class="d-table-td in-w-1"><span>3</span></div>
                            <div class="d-table-td in-w-2">
                                <pre>Item 3</pre>
                            </div>
                            <div class="d-table-td in-w-3">
                                1
                            </div>
                            <div class="d-table-td in-w-4 text-right"><span ><?php echo getCurrencyAmount(100, true); ?></span></div>
                        </div>
                    </div>
                    <div class="d-table-footer">
                        <div class="d-table-controls"></div>
                            <div class="d-table-summary">
                               <div class="d-table-summary-item">
                                    <div class="tu d-table-label"><strong >Amount:</strong></div>
                                    <div class="d-table-value"><?php echo getCurrencyAmount(300, true); ?></div>
                               </div>
                               <div class="d-table-summary-item">
                                    <div class="tu d-table-label"><strong >Discount:</strong></div>
                                    <div class="d-table-value"><?php echo getCurrencyAmount(50, true); ?></div>
                               </div>
                               <div class="d-table-summary-item">
                                    <div class="tu d-table-label"><strong >Tax:</strong></div>
                                    <div class="d-table-value">0%</div>
                               </div>
                               <div class="d-table-summary-item">
                                    <div class="fwb f-b tu d-table-label"><strong style="color:{{:invColor}}">Total:</strong></div>
                                    <div class="fwb f-b d-table-value" style="color:{{:invColor}}"><?php echo getCurrencyAmount(250, true); ?></div>
                               </div>
                            </div>
                        </div>
                    </div>
                    <div class="break-25"></div>
                     <div class="row">
                            <div class="d-col-3">
                                <h4 class="d-fancy-title mb5">Notes:</h1>
                                <p class="font-color-gray">
                                Paypal , Stripe & manual payment method accept.<br>
                                Net 10 – Payment due in 10 days from invoice date.<br>
                                Net 30 – Payment due in 30 days from invoice date.
                                </p>
                            </div>
                            <div class="d-col-3">
                                <h4 class="d-fancy-title mb5">Terms:</h1>
                                <p class="font-color-gray">Invoice payment terms ; 1% 10 Net 30, 1% discount if payment received within ten days otherwise payment 30 days after invoice date.</p>
                            </div>
                     </div>
                    <div class="break-50"></div>
                    <div class="row">
<!--                        <div class="l-col-66"><p class="thank" style="color:{{:invColor}}">Thank you!</p></div>-->
                        <div class="l-col-33"></div>
                    </div>
                    <div class="d-header-50">
                         <p style="color:{{:invColor}}"><strong class="b">Regards :</strong></p>
                         <span>{{:companyName}}</span> 
                    </div>
                </div>
            </div>
        </div>    





</script>

<script id="istanbulTemplate" type="type/x-jsrender">
    <div class="preview-main client-preview">
        <div class="d" id="boxes">
            <div class="d-inner">
                <div class="row">
                    <div class="col-66">
                        <h1 class="i-fancy-title tu mb5" style="background:{{:invColor}};color : white;">INVOICE</h1>
                    </div>
                    <div class="col-33">
                        <img src="<?php echo getLogoUrl() ?>"
                             class="img-logo">
                        <div class="break-25"></div>
                        <p class="p-text mb-0">{{:companyName}}</p>
                        <p class="p-text mb-0">{{:companyAddress}}</p>
                        <p class="p-text mb-0">Mo: {{:companyPhone}}</p>
                    </div>
                </div>
                <br>
                <div class="row" style="margin-right: 15px">
                    <div class="col-66">
                        <strong class="tu mb5 to-font-size">To</strong>
                        <p class="p-text">
                            &ltClient Name&gt;<br>
                            &ltClient Email&gt;<br>
                            &ltClient Address&gt;
                        </p>
                    </div>
                    <div class="col-33">
                        <table class="summary-table">
                            <tbody>
                            <tr>
                                <td class="tu fwb">Invoice ID:</td>
                                <td class="text-right">#22DA93</td>
                            </tr>
                            <tr>
                                <td class="tu fwb">Invoice Date:</td>
                                <td class="text-right">25th Nov, 2020 8:03 AM</td>
                            </tr>
                            <tr>
                                <td class="tu fwb">Due Date:</td>
                                <td class="text-right">26 Nov 2020</td>
                            </tr>
                            </tbody>
                        </table>
                    </div>
                </div>
                <div class="table d-table">
                    <div class="tu d-table-tr" style="border-top: 2px solid {{:invColor}};">
                        <div class="d-table-th in-w-1">#</div>
                        <div class="d-table-th in-w-2">Item</div>
                        <div class="d-table-th in-w-3">Qty</div>
                        <div class="d-table-th in-w-4 text-right">Amount</div>
                    </div>
                    <div class="d-table-body">
                        <div class="d-table-tr" style="border-bottom: 1px solid #ffffff;">
                            <div class="d-table-td in-w-1"><span>1</span></div>
                            <div class="d-table-td in-w-2">
                                <pre>Item 1</pre>
                            </div>
                            <div class="d-table-td in-w-3">
                                1
                            </div>
                            <div class="d-table-td in-w-4 text-right"><span ><?php echo getCurrencyAmount(100, true); ?></span></div>
                        </div>
                        <div class="d-table-tr" style="border-bottom: 1px solid #ffffff;">
                            <div class="d-table-td in-w-1"><span>2</span></div>
                            <div class="d-table-td in-w-2">
                                <pre>Item 2</pre>
                            </div>
                            <div class="d-table-td in-w-3">
                                1
                            </div>
                            <div class="d-table-td in-w-4 text-right"><span ><?php echo getCurrencyAmount(100, true); ?></span></div>
                        </div>
                        <div class="d-table-tr" style="border-bottom: 2px solid {{:invColor}};">
                            <div class="d-table-td in-w-1"><span>3</span></div>
                            <div class="d-table-td in-w-2">
                                <pre>Item 3</pre>
                            </div>
                            <div class="d-table-td in-w-3">
                                1
                            </div>
                            <div class="d-table-td in-w-4 text-right"><span ><?php echo getCurrencyAmount(100, true); ?></span></div>
                        </div>
                    </div>
                    <div class="d-table-footer">
                        <div class="d-table-controls"></div>
                            <div class="d-table-summary">
                               <div class="d-table-summary-item">
                                    <div class="tu d-table-label"><strong >Amount:</strong></div>
                                    <div class="d-table-value"><?php echo getCurrencyAmount(300, true); ?></div>
                               </div>
                               <div class="d-table-summary-item">
                                    <div class="tu d-table-label"><strong >Discount:</strong></div>
                                    <div class="d-table-value"><?php echo getCurrencyAmount(50, true); ?></div>
                               </div>
                               <div class="d-table-summary-item">
                                    <div class="tu d-table-label"><strong >Tax:</strong></div>
                                    <div class="d-table-value">0%</div>
                               </div>
                               <div class="d-table-summary-item" style="border-bottom: 2px solid {{:invColor}};">
                                    <div class="tu d-table-label"><strong >Total:</strong></div>
                                    <div class="d-table-value"><?php echo getCurrencyAmount(250, true); ?></div>
                               </div>
                            </div>
                        </div>
                    </div>
                    <div class="break-25"></div>
                     <div class="row">
                            <div class="d-col-3">
                                <h4 class="d-fancy-title mb5">Notes:</h1>
                                <p class="font-color-gray">
                                Paypal , Stripe & manual payment method accept.<br>
                                Net 10 – Payment due in 10 days from invoice date.<br>
                                Net 30 – Payment due in 30 days from invoice date.
                                </p>
                            </div>
                            <div class="d-col-3">
                                <h4 class="d-fancy-title mb5">Terms:</h1>
                                <p class="font-color-gray">Invoice payment terms ; 1% 10 Net 30, 1% discount if payment received within ten days otherwise payment 30 days after invoice date.</p>
                            </div>
                      </div>
                      <br>
                    <div class="d-header-50">
                        <br><p><strong class="b text-black">Regards:</strong></p>
                        <span>{{:companyName}}</span> 
                </div>
            </div>
        </div>
    </div>





</script>

<script id="mumbaiTemplate" type="text/x-jsrender">
    <div class="preview-main client-preview">
        <div class="d" id="boxes">
            <div class="d-inner" style="border-top: 15px solid {{:invColor}}">
                <div class="row">
                    <div class="d-col-3">
                        <h1 class="fancy-title mb5">INVOICE</h1>
                    </div>
                    <div class="d-col-1" style="padding-left: 10px !important">
                    <img  src="<?php echo getLogoUrl() ?>"
                                              class="img-logo">
                    </div>
                </div>
                <div class="break-50"></div>
                <div class="row">
                    <div class="d-col-2">
                        <strong class="from-font-size">From</strong><br>
                        <p class="p-text mb-0">{{:companyName}}</p>
                        <p class="p-text mb-0">{{:companyAddress}}</p>
                        <p class="p-text mb-0">Mo: {{:companyPhone}}</p>
                    </div>
                    <div class="d-col-2">
                        <div class="col-66">
                            <strong style="margin-bottom: 3px" class="to-font-size">To</strong><br>
                            <p class="p-text">
                                &ltClient Name&gt;<br>
                                &ltClient Email&gt;<br>
                                &ltClient Address&gt;
                            </p>
                        </div>
                    </div>
                </div>
                <div class="break-25"></div>
                <hr style="background:{{:invColor}}">
                <div class="break-25"></div>
                <div class="row">
                    <div class="d-col-33">
                        <table class="summary-table">
                            <tbody>
                            <tr>
                                <td class="fwb">Invoice ID:</td>
                                <td class="text-right">#5F2I93</td>
                            </tr>
                            <tr>
                                <td class="fwb">Invoice Date:</td>
                                <td class="text-right">25th Nov, 2020 8:03 AM</td>
                            </tr>
                            <tr>
                                <td class="fwb">Due Date:</td>
                                <td class="text-right">26 Nov 2020</td>
                            </tr>
                            </tbody>
                        </table>
                    </div>
                </div>
                <div class="table d-table">
                    <div class="tu d-table-tr" style="border-bottom: 2px solid {{:invColor}};">
                        <div class="d-table-th in-w-1">#</div>
                        <div class="d-table-th in-w-2">Item</div>
                        <div class="d-table-th in-w-3">Qty</div>
                        <div class="d-table-th in-w-4 text-right">Amount</div>
                    </div>
                    <div class="d-table-body">
                        <div class="d-table-tr">
                            <div class="d-table-td in-w-1"><span>1</span></div>
                            <div class="d-table-td in-w-2">
                                <pre>Item 1</pre>
                            </div>
                            <div class="d-table-td in-w-3">
                                1
                            </div>
                            <div class="d-table-td in-w-4 text-right"><span ><?php echo getCurrencyAmount(100, true); ?></span></div>
                        </div>
                        <div class="d-table-tr">
                            <div class="d-table-td in-w-1"><span>2</span></div>
                            <div class="d-table-td in-w-2">
                                <pre>Item 2</pre>
                            </div>
                            <div class="d-table-td in-w-3">
                                1
                            </div>
                            <div class="d-table-td in-w-4 text-right"><span ><?php echo getCurrencyAmount(100, true); ?></span></div>
                        </div>
                        <div class="d-table-tr" style="border-bottom: 2px solid {{:invColor}};">
                            <div class="d-table-td in-w-1"><span>3</span></div>
                            <div class="d-table-td in-w-2">
                                <pre>Item 3</pre>
                            </div>
                            <div class="d-table-td in-w-3">
                                1
                            </div>
                            <div class="d-table-td in-w-4 text-right"><span ><?php echo getCurrencyAmount(100, true); ?></span></div>
                        </div>
                    </div>
                    <div class="d-table-footer">
                        <div class="d-table-controls"></div>
                            <div class="d-table-summary">
                               <div class="d-table-summary-item">
                                    <div class="tu d-table-label"><strong >Amount:</strong></div>
                                    <div class="d-table-value"><?php echo getCurrencyAmount(300, true); ?></div>
                               </div>
                               <div class="d-table-summary-item">
                                    <div class="tu d-table-label"><strong >Discount:</strong></div>
                                    <div class="d-table-value"><?php echo getCurrencyAmount(50, true); ?></div>
                               </div>
                               <div class="d-table-summary-item">
                                    <div class="tu d-table-label"><strong >Tax:</strong></div>
                                    <div class="d-table-value">0%</div>
                               </div>
                               <div class="d-table-summary-item">
                                    <div class="tu d-table-label"><strong >Total:</strong></div>
                                    <div class="d-table-value"><?php echo getCurrencyAmount(250, true); ?></div>
                               </div>
                            </div>
                        </div>
                    </div>
                    <div class="break-25"></div>
                     <div class="row">
                            <div class="d-col-3">
                                <h4 class="d-fancy-title mb5">Notes:</h1>
                                <p class="font-color-gray">
                                Paypal , Stripe & manual payment method accept.<br>
                                Net 10 – Payment due in 10 days from invoice date.<br>
                                Net 30 – Payment due in 30 days from invoice date.
                                </p>
                            </div>
                            <div class="d-col-3">
                                <h4 class="d-fancy-title mb5">Terms:</h1>
                                <p class="font-color-gray">Invoice payment terms ; 1% 10 Net 30, 1% discount if payment received within ten days otherwise payment 30 days after invoice date.</p>
                            </div>
                      </div>
                      <br>
                    <div class="break-25"></div>
                    <div class="d-header-50">
                        <p style="color:{{:invColor}}"><strong class="b">Regards:</strong></p>
                        <span>{{:companyName}}</span> 
                </div>
            </div>
        </div>
    </div>







</script>

<script id="hongKongTemplate" type="text/x-jsrender">
    <div class="preview-main client-preview">
        <div class="d" id="boxes">
            <div class="d-inner d-no-pad">
                <div class="row hk-grey-box">
                    <div class="col-33">
                    <img src="<?php echo getLogoUrl() ?>"
                                             class="img-logo"  style="max-width: 150px;"><br><br>
                        <p class="p-text mb-o" style="color:{{:invColor}}">{{:companyName}}</p>
                        <p class="p-text mb-0">{{:companyAddress}}</p>
                        <p class="p-text mb-0">Mo: {{:companyPhone}}</p>
                    </div>
                    <div class="col-33">&nbsp;</div>
                    <div class="col-33">
                        <h1 class="fancy-title mb5" style="color:{{:invColor}}">INVOICE</h1><br><br>
                        <table class="summary-table">
                            <tbody>
                            <tr>
                                <td class="fwb">Invoice ID:</td>
                                <td class="text-right">#51ET78</td>
                            </tr>
                            <tr>
                                <td class="fwb">Invoice Date:</td>
                                <td class="text-right">25 Nov 2020 8:03 AM</td>
                            </tr>
                            <tr>
                                <td class="fwb">Due Date:</td>
                                <td class="text-right">26 Nov 2020</td>
                            </tr>
                            </tbody>
                        </table>
                    </div>
                </div>
                <div class="row hk-grey-box">
                    <div class="to-address-right">
                        <strong class="to-font-size">To</strong><br>
                        <p class="p-text">
                            &ltClient Name&gt;<br>
                            &ltClient Email&gt;<br>
                            &ltClient Address&gt;
                        </p>
                    </div>
                    <div class="break-25"></div>
                    <div class="table hk-table">
                        <div class="tu d-table-tr">
                            <div class="d-table-th in-w-1" style="border: 1px solid {{:invColor}};padding: 5px;">#</div>
                            <div class="d-table-th in-w-2" style="border: 1px solid {{:invColor}};padding: 5px;">Item</div>
                            <div class="d-table-th in-w-3" style="border: 1px solid {{:invColor}};padding: 5px;">Qty</div>
                            <div class="d-table-th in-w-4 text-right" style="border: 1px solid {{:invColor}};padding: 5px;">Amount</div>
                        </div>
                        <div class="<d-table-body">
                            <div class="d-table-tr">
                                <div class="d-table-td in-w-1" style="border: 1px solid {{:invColor}};padding: 5px;"><span>1</span></div>
                                <div class="d-table-td in-w-2" style="border: 1px solid {{:invColor}};padding: 5px;">
                                    <pre>Item 1</pre>
                                </div>
                                <div class="d-table-td in-w-3" style="border: 1px solid {{:invColor}};padding: 5px;">
                                    1
                                </div>
                                <div class="d-table-td in-w-4 text-right" style="border: 1px solid {{:invColor}};padding: 5px;"><span ><?php echo getCurrencyAmount(100, true); ?></span></div>
                            </div>
                            <div class="d-table-tr">
                                <div class="d-table-td in-w-1" style="border: 1px solid {{:invColor}};padding: 5px;"><span>2</span></div>
                                <div class="d-table-td in-w-2" style="border: 1px solid {{:invColor}};padding: 5px;">
                                    <pre>Item 2</pre>
                                </div>
                                <div class="d-table-td in-w-3" style="border: 1px solid {{:invColor}};padding: 5px;">
                                    1
                                </div>
                                <div class="d-table-td in-w-4 text-right" style="border: 1px solid {{:invColor}};padding: 5px;"><span ><?php echo getCurrencyAmount(100, true); ?></span></div>
                            </div>
                            <div class="d-table-tr">
                                <div class="d-table-td in-w-1" style="border: 1px solid {{:invColor}};padding: 5px;"><span>3</span></div>
                                <div class="d-table-td in-w-2" style="border: 1px solid {{:invColor}};padding: 5px;">
                                    <pre>Item 3</pre>
                                </div>
                                <div class="d-table-td in-w-3" style="border: 1px solid {{:invColor}};padding: 5px;">
                                    1
                                </div>
                                <div class="d-table-td in-w-4 text-right" style="border: 1px solid {{:invColor}};padding: 5px;"><span ><?php echo getCurrencyAmount(100, true); ?></span></div>
                            </div>
                        </div>
                        <div class="d-table-footer">
                            <div class="d-table-controls"></div>
                            <div class="d-table-summary">
                               <div class="d-table-summary-item">
                                    <div class="tu d-table-label"><strong >Amount:</strong></div>
                                    <div class="d-table-value"><?php echo getCurrencyAmount(300, true); ?></div>
                               </div>
                               <div class="d-table-summary-item">
                                    <div class="tu d-table-label"><strong >Discount:</strong></div>
                                    <div class="d-table-value"><?php echo getCurrencyAmount(50, true); ?></div>
                               </div>
                               <div class="d-table-summary-item">
                                    <div class="tu d-table-label"><strong >Tax:</strong></div>
                                    <div class="d-table-value">0%</div>
                               </div>
                               <div class="d-table-summary-item">
                                    <div class="tu d-table-label"><strong >Total:</strong></div>
                                    <div class="d-table-value"><?php echo getCurrencyAmount(250, true); ?></div>
                               </div>
                            </div>
                        </div>
                    </div>
                    <div class="break-25"></div>
                     <div class="row">
                            <div class="d-col-3">
                                <h4 class="d-fancy-title mb5">Notes:</h1>
                                <p class="font-color-gray">
                                Paypal , Stripe & manual payment method accept.<br>
                                Net 10 – Payment due in 10 days from invoice date.<br>
                                Net 30 – Payment due in 30 days from invoice date.
                                </p>
                            </div>
                            <div class="d-col-3">
                                <h4 class="d-fancy-title mb5">Terms:</h1>
                                <p class="font-color-gray">Invoice payment terms ; 1% 10 Net 30, 1% discount if payment received within ten days otherwise payment 30 days after invoice date.</p>
                            </div>
                      </div>
                      <br>
                    <div class="hk-header-50">
                        <p class="b"><strong>Regards:</strong></p>
                        <span style="color:{{:invColor}}">{{:companyName}}</span>
                    </div>
                </div>
            </div>
        </div>
    </div>






</script>

<script id="tokyoTemplate" type="text/x-jsrender">
    <div class="preview-main client-preview">
        <div class="d" id="boxes">
            <div class="d-inner" style="border-top: 15px solid {{:invColor}}; border-bottom: 15px solid {{:invColor}};">
                <div class="row">
                    <div class="col-66">
                        <img  src="<?php echo getLogoUrl() ?>"
                              class="img-logo" style="max-width: 100px;">
                        <br><h6 class="p-text mb-0" style="color:{{:invColor}}">{{:companyName}}</h6>
                        <p class="p-text mb-0 w-75">{{:companyAddress}}</p>
                        <p class="p-text mb-0">Mo: {{:companyPhone}}</p>
                    </div>
                    <div class="col-33">
                        <h1 class="fancy-title mb5" style="color:{{:invColor}}">INVOICE</h1>
                    </div>
                </div>
                <br>
                <div class="row" style="margin-right: 15px">
                    <div class="col-66">
                        <strong class="mb5 to-font-size" style="color:{{:invColor}}">To</strong>
                        <p class="p-text">
                            &ltClient Name&gt;<br>
                            &ltClient Email&gt;<br>
                            &ltClient Address&gt;
                        </p>
                    </div>
                    <div class="col-33">
                        <table class="summary-table">
                            <tbody>
                            <tr>
                                <td class="fwb">Invoice ID:</td>
                                <td class="text-right">#24GD74</td>
                            </tr>
                            <tr>
                                <td class="fwb">Invoice Date:</td>
                                <td class="text-right">25 Nov 2020 8:03 AM</td>
                            </tr>
                            <tr>
                                <td class="fwb">Due Date:</td>
                                <td class="text-right">26 Nov 2020</td>
                            </tr>
                            </tbody>
                        </table>
                    </div>
                </div>
                <div class="table d-table">
                    <div class="tu d-table-tr" style="border-top: 2px solid {{:invColor}};">
                        <div class="d-table-th in-w-1">#</div>
                        <div class="d-table-th in-w-2">Item</div>
                        <div class="d-table-th in-w-3">Qty</div>
                        <div class="d-table-th in-w-4 text-right">Amount</div>
                    </div>
                    <div class="<d-table-body">
                        <div class="d-table-tr">
                            <div class="d-table-td in-w-1"><span>1</span></div>
                            <div class="d-table-td in-w-2">
                                <pre>Item 1</pre>
                            </div>
                            <div class="d-table-td in-w-3">
                                1
                            </div>
                            <div class="d-table-td in-w-4 text-right"><span ><?php echo getCurrencyAmount(100, true); ?></span></div>
                        </div>
                        <div class="d-table-tr">
                            <div class="d-table-td in-w-1"><span>2</span></div>
                            <div class="d-table-td in-w-2">
                                <pre>Item 2</pre>
                            </div>
                            <div class="d-table-td in-w-3">
                                1
                            </div>
                            <div class="d-table-td in-w-4 text-right"><span ><?php echo getCurrencyAmount(100, true); ?></span></div>
                        </div>
                        <div class="d-table-tr" style="border-bottom: 2px solid {{:invColor}};">
                            <div class="d-table-td in-w-1"><span>3</span></div>
                            <div class="d-table-td in-w-2">
                                <pre>Item 3</pre>
                            </div>
                            <div class="d-table-td in-w-3">
                                1
                            </div>
                            <div class="d-table-td in-w-4 text-right"><span ><?php echo getCurrencyAmount(100, true); ?></span></div>
                        </div>
                    </div>
                    <div class="d-table-footer">
                        <div class="d-table-controls"></div>
                        <div class="d-table-summary">
                           <div class="d-table-summary-item">
                                <div class="tu d-table-label"><strong >Amount:</strong></div>
                                <div class="d-table-value"><?php echo getCurrencyAmount(300, true); ?></div>
                           </div>
                           <div class="d-table-summary-item">
                                <div class="tu d-table-label"><strong >Discount:</strong></div>
                                <div class="d-table-value"><?php echo getCurrencyAmount(50, true); ?></div>
                           </div>
                           <div class="d-table-summary-item">
                                <div class="tu d-table-label"><strong >Tax:</strong></div>
                                <div class="d-table-value">0%</div>
                           </div>
                           <div class="d-table-summary-item" style="border-bottom: 2px solid {{:invColor}};">
                                <div class="tu d-table-label"><strong >Total:</strong></div>
                                <div class="d-table-value"><?php echo getCurrencyAmount(250, true); ?></div>
                           </div>
                        </div>
                    </div>
                </div>
                <div class="break-25"></div>
                 <div class="row">
                            <div class="d-col-3">
                                <h4 class="d-fancy-title mb5">Notes:</h1>
                                <p class="font-color-gray">
                                Paypal , Stripe & manual payment method accept.<br>
                                Net 10 – Payment due in 10 days from invoice date.<br>
                                Net 30 – Payment due in 30 days from invoice date.
                                </p>
                            </div>
                            <div class="d-col-3">
                                <h4 class="d-fancy-title mb5">Terms:</h1>
                                <p class="font-color-gray">Invoice payment terms ; 1% 10 Net 30, 1% discount if payment received within ten days otherwise payment 30 days after invoice date.</p>
                            </div>
                      </div>
                      <br>
                <div class="d-header-50">
                    <p class="b"><strong>Regards:</strong></p>
                    <span style="color: {{:invColor}}">{{:companyName}}</span>
                </div>
            </div>
        </div>
    </div>





</script>

<script id="parisTemplate" type="text/x-jsrender">
    <div class="preview-main client-preview">
        <div class="d" id="boxes">
            <div class="d-inner">
                <div class="row">
                    <div class="col-33">
                        <h1 class="p-fancy-title tu mb5" style="border-bottom: 10px solid {{:invColor}};">INVOICE</h1>
                    </div>
                    <div class="col-33"></div>
                    <div class="col-33">
                        <img src="<?php echo getLogoUrl() ?>"
                                             class="img-logo" style="max-width: 150px;"></div>
                </div>
                <br>
                <div class="row" style="margin-right: 15px">
                    <div class="col-66">
                        <strong class="tu mb5 from-font-size" style="color:{{:invColor}}">From</strong>
                        <p class="p-text mb-0">{{:companyName}}</p>
                        <p class="p-text mb-0 w-75">{{:companyAddress}}</p>
                        <p class="p-text mb-0">Mo: {{:companyPhone}}</p>
                    </div>  
                    <div class="col-33">
                        <table class="summary-table">
                            <tbody>
                            <tr>
                                <td class="tu fwb text-black">Invoice ID:</td>
                                <td class="text-right">#56PC98</td>
                            </tr>
                            <tr>
                                <td class="tu fwb text-black">Invoice Date:</td>
                                <td class="text-right">25 Nov 2020 8:03 AM</td>
                            </tr>
                            <tr>
                                <td class="tu fwb text-black">Due Date:</td>
                                <td class="text-right">26 Nov 2020</td>
                            </tr>
                            </tbody>
                        </table>
                    </div>
                </div>
                <div class="break-25"></div>
                <div class="row">
                    <div class="p-col-2">
                        <div class="col-66">
                            <strong class="tu mb5 to-font-size" style="color:{{:invColor}}">To</strong>
                            <p class="p-text">                                
                                &ltClient Name&gt;<br>
                                &ltClient Email&gt;<br>
                                &ltClient Address&gt;
                            </p>
                        </div>
                    </div>
                </div>
                <div class="table d-table">
                    <div class="tu d-table-tr" style="color: {{:invColor}};border-top: 2px solid {{:invColor}};border-bottom: 2px solid {{:invColor}}">
                        <div class="d-table-th in-w-1">#</div>
                        <div class="d-table-th in-w-2">Item</div>
                        <div class="d-table-th in-w-3">Qty</div>
                        <div class="d-table-th in-w-4 text-right">Amount</div>
                    </div>
                    <div class="<d-table-body">
                        <div class="d-table-tr">
                            <div class="d-table-td in-w-1"><span>1</span></div>
                            <div class="d-table-td in-w-2">
                                <pre>Item 1</pre>
                            </div>
                            <div class="d-table-td in-w-3">
                                1
                            </div>
                            <div class="d-table-td in-w-4 text-right"><span ><?php echo getCurrencyAmount(100, true); ?></span></div>
                        </div>
                        <div class="d-table-tr">
                            <div class="d-table-td in-w-1"><span>2</span></div>
                            <div class="d-table-td in-w-2">
                                <pre>Item 2</pre>
                            </div>
                            <div class="d-table-td in-w-3">
                                1
                            </div>
                            <div class="d-table-td in-w-4 text-right"><span ><?php echo getCurrencyAmount(100, true); ?></span></div>
                        </div>
                        <div class="d-table-tr">
                            <div class="d-table-td in-w-1"><span>3</span></div>
                            <div class="d-table-td in-w-2">
                                <pre>Item 3</pre>
                            </div>
                            <div class="d-table-td in-w-3">
                                1
                            </div>
                            <div class="d-table-td in-w-4 text-right"><span ><?php echo getCurrencyAmount(100, true); ?></span></div>
                        </div>
                    </div>
                    <div class="d-table-footer">
                        <div class="d-table-controls"></div>
                        <div class="d-table-summary">
                           <div class="d-table-summary-item">
                                <div class="tu d-table-label"><strong >Amount:</strong></div>
                                <div class="d-table-value"><?php echo getCurrencyAmount(300, true); ?></div>
                           </div>
                           <div class="d-table-summary-item">
                                <div class="tu d-table-label"><strong >Discount:</strong></div>
                                <div class="d-table-value"><?php echo getCurrencyAmount(50, true); ?></div>
                           </div>
                           <div class="d-table-summary-item">
                                <div class="tu d-table-label"><strong >Tax:</strong></div>
                                <div class="d-table-value">0%</div>
                           </div>
                           <div class="d-table-summary-item">
                                <div class="tu d-table-label"><strong >Total:</strong></div>
                                <div class="d-table-value" style="color: {{:invColor}};"><?php echo getCurrencyAmount(250, true); ?></div>
                           </div>
                        </div>
                    </div>
                </div>
                <div class="break-25"></div>
                 <div class="row">
                            <div class="d-col-3">
                                <h4 class="d-fancy-title mb5">Notes:</h1>
                                <p class="font-color-gray">
                                Paypal , Stripe & manual payment method accept.<br>
                                Net 10 – Payment due in 10 days from invoice date.<br>
                                Net 30 – Payment due in 30 days from invoice date.
                                </p>
                            </div>
                            <div class="d-col-3">
                                <h4 class="d-fancy-title mb5">Terms:</h1>
                                <p class="font-color-gray">Invoice payment terms ; 1% 10 Net 30, 1% discount if payment received within ten days otherwise payment 30 days after invoice date.</p>
                            </div>
                      </div>
                      <br>
                <div class="d-header-50">
                        <p><strong class="b">Regards:</strong></p>
                        <span style="color:{{:invColor}}">{{:companyName}}</span> 
                </div>
            </div>
        </div>
    </div>

</script>


