<!DOCTYPE html>
<html lang="en">
    <head>
        <meta charset="UTF-8">
        <title>Team Table</title>
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <link rel="stylesheet" href="style.css">
        @vite(['resources/css/example.css', 'resources/js/example.js'])
    </head>
    <body>
			<div class="table-widget">
			<div>
				sadasd
			</div>
			<table>
				<caption>
					Team Members
					<span class="table-row-count"></span>
				</caption>
				<thead>
					<tr>
						<th>Name</th>
						<th>Status</th>
						<th>Email address</th>
						<th>Tags</th>
					</tr>
				</thead>
				<tbody id="team-member-rows">
					<!--? rows are generated -->
				</tbody>
				<tfoot>
					<tr>
						<td colspan="4">
							<ul class="pagination">
								<!--? generated pages -->
							</ul>
						</td>
					</tr>
				</tfoot>
			</table>
		</div>
		<script src="script.js"></script>
    </body>
</html>



