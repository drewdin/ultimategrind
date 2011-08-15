			<div id="footer">
				<p>&copy;
				<?php
				$startYear = 2010;
				$thisYear = date( 'Y' );
				
				if( $startYear == $thisYear ) {
					
					echo $startYear;
					
				} else {
					
					echo "{$startYear}&#8212;{$thisYear}";
					
				}
				?>
				The Ultimate Grind</p>
			</div> 
		</div>
	</body>
</html>