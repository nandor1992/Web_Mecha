<?php
session_start();
?>
<!-- Header -->
<?php
$title= "Help";
$style=2;
include 'header.php';
?>
            	<section id="sec-1">
                     
                    <div id="page-title"><h3>Details of Consumers and Producers Price indexes</h3></div>
                    </div>
               	</section>
				<section id="sec-2">
				<h2>Producer Price Indices</h2>
				<p>The reports covering Producer Price Indices in Eurostat are:</p>
				<ol>
				<li><p>Producer Price in Industry, Domestic Market, Annual Data (2010=100) Pathway: Database>Industry, Trade and Services>Short Term Business Statistics>Industry>Producer Prices in Industry>Producer Prices in Industry,Domestic Market Link <a href="http://appsso.eurostat.ec.europa.eu/nui/show.do?dataset=sts_inppd_a&lang=en">Link</a></p></li>
				<li><p>Construction Cost (or Producer Price), New Residential Building – Annual Data (2010=100) Pathway: Database>Industry, Trade and Services>Short Term Business Statistics>Construction, Building and Civil Engineering>Construction Cost (or Producer Price), New Residential Buildings <a href="http://appsso.eurostat.ec.europa.eu/nui/show.do?dataset=sts_copi_a&lang=en">Link</a></p>
				</li>
				<li><p>Service Producer Prices – Annual Data (2010=100) Pathway: Database>Industry, Trade and Services>Services>Service Producer Prices 
				<a href="http://appsso.eurostat.ec.europa.eu/nui/show.do?dataset=sts_sepp_a&lang=en">Link</a></p>
				</li>				
				</ol>
				<p>Here, for first time the reports of Eurostat present problems. They are well detailed, 4th digit but for quite a lot of countries, for quite a lot of industries at 4th and 3rd digit the cells are decorated with “:” – no data available.</p></br>
				<p>
				So, we have to check the National Statistics. I, myself, find the databases of Statistics of Sweden and Finland most “user (me) friendly. The idea is that the different National Statistics Offices can have different rules, different practices, different thresholds for “Confidential” and their data releases can differ but if the National Office of a European country releases data at certain level of disaggregation (details) the others should be able to supply it under request (if the “Confidentiality” and “Reliability” requirements permit it). And for a side look we will pass the Database of Latvia and Estonia. Let us see what can be found there.</p></br>
				<b>Sweden</b>
				<ol>
				<li><p>The report is Producer Price Index by Products SPIN 2007 1990-2013, 2005=100. Pathway: Stat Database> Prices and Consumption> Producer and Import Price Index> Spin 2007, Year>… <a href="http://www.statistikdatabasen.scb.se/pxweb/en/ssd/START__PR__PR0301__PR0301E/PPIAr07/?rxid=475a039f-de03-4a25-b562-c700ef33651e">Link</a></br>There are no missing data. Practically all industries are represented with the yearly price index at 4th digit.</p></li>
				<li><p>For the Services the report is Producer Price Index by Products SPIN 2007 1995-2013 Pathway: Stat Database> Prices and Consumption> Producer Price Index for Services>… <a href="http://www.statistikdatabasen.scb.se/pxweb/en/ssd/START__PR__PR0801/TPI2005Ar07/?rxid=475a039f-de03-4a25-b562-c700ef33651e">Link</a></p>
				<p>All the figures are there, at 4th digit detail.</p></li>
				</ol></br>
				<b> Finland</b>
				<ol>
				<li><p>The report is Producer Price Indices 2010=100 Pathway: StatFin>Prices and Costs>Producer Price Indices>… <a href="http://pxweb2.stat.fi/Dialog/varval.asp?ma=009_thi_tau_009&ti=Producer+Price+Indices+2010%3D100+%28TOL2008%29&path=../Database/StatFin/hin/thi/&lang=1&multilang=en">Link</a></br>The figures for Manufacturing, Water, Electricity are there – 4th digit, but Construction is “Construction” and nothing else.</p></li>
				<li><p>The Services’ report is Producer Price Indices for Services. Pathway: StatFin> Prices and Costs>… <a href="http://pxweb2.stat.fi/Dialog/varval.asp?ma=004_pthi_tau_004&ti=Producer+Price+Indices+for+Services+2010%3D100+%28TOL+2008%29&path=../Database/StatFin/hin/pthi/&lang=1&multilang=en">Link</a></p>
				<p>Many of the services are represented at 4th digit but there are many at 2nd and 3rd digit. There are Annual and Quarterly options.</p></li>
				</ol></br>
				<b> Latvia</b>
				<ol>
				<li><p>The report for Industries is RC01 Producer Price Indices and Changes in Industry Sector Pathway: Database>Economy and Finance>Short Term Statistical Data>Producer Prices <a href="http://data.csb.gov.lv/pxweb/en/ekfin/ekfin__isterm__RCI/RC0010m.px/?rxid=a79839fe-11ba-4ecd-8cc3-4035692c5fc8">Link</a></br>In this report the data is disaggregated up to 2nd digit but this is a regular release and under request there for sure will appear more detailed data.</p></li>
				<li><p>For Services the report is RC04 Producer Price Indices and Changes for Service Sections Pathway: Database>Economy and Finance>Short Term Statistical Data>Producer Prices <a href="http://data.csb.gov.lv/pxweb/en/ekfin/ekfin__isterm__RCI/RC0040c.px/?rxid=a79839fe-11ba-4ecd-8cc3-4035692c5fc8">Link</a></p>
				<p>Here some of the Service Sectors appear up to 4th digit, others – at 3rd, some – at 2nd. This confirms that data at 4th digit should be principally available upon request.</p></li>
				</ol></br>
				<b>Estonia</b>
				<p>The Prices Indices are released by the Statistical Office at letter level of aggregation, so they are of no practical use for TECoL</p>
				</br><p>Having those levels of release in mind we know several things:</p>
				<ol>
				<li><p>Apart from “Confidential” and “Not Reliable” there should be no real problem the Producer Price Indices to be delivered at 4th digit level upon request from every National Statistic in Europe.</p></li>
				<li><p>The construction of the database navigation tree is not supposed to demonstrate substantial differences i.e. we know where to look for the Producer Price Indices – Prices and Consumption, Prices and Costs, Short Time Business Statistics etc.</p></li>
				<li><p>We have a “coordination system” that will enable us to put very clearly our request for data at Regional Market level.</p></li>
				</br>
				</section>
				<section id="sec-2">
				<h2>Consumer Price Indices</h2>
				<p>The indices of the Consumer Prices in some of the National Statistics present a well-developed and well detailed system that can supply a base for scrutinizing the behavior of a market segment. The difference is that it is products, not industries, that are targeted by CPI. This has certain advantages from a consumer’s vantage point and, of course, it can be used by both types of TECoL Users – consumers and enterprise owners. But, considering the latter as the major User we will recommend the Producer Price Indices to be implemented.</p></br>
				<p><b>What really matters is that throughout the whole TECoL Process the User should utilize one and the same type of indices – Consumer or Producer. </b></p>
				<p>In Eurostat Consumer Price Indices refer to US, Japan but somehow not to the European countries</p>
				<ol>
				<li><p><b>Sweden:</b> The report is Consumer Price Index by Product Group (COICOP) 1980=100 Pathway: Database>Prices and Consumption>Consumer Price Index <a href="http://www.statistikdatabasen.scb.se/pxweb/en/ssd/START__PR__PR0101__PR0101A/KPICOI80M/?rxid=8d0b0a93-5f02-40f6-95d6-02c8d8866712">Link</a>				</p></li></br>
				<li><p><b>Finland:</b>Consumer Price Index 2010=100 Pathway: StatFin>Prices and Costs>Consumer Price Index <a href="http://pxweb2.stat.fi/Dialog/varval.asp?ma=008_khi_tau_109_en&ti=Consumer+Price+Index+2010%3D100&path=../Database/StatFin/hin/khi/&lang=1&multilang=en">Link</a>
				</p></li></br>
				</section>
				
                            
                                       <?php
include 'footer.php';
?>