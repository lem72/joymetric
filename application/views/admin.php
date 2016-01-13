        <div class="row">
            <div class="span3">
            	<div class="well" style="max-width: 340px; padding: 8px 0;">
            	<ul class="nav nav-list">
  					<li class="nav-header">Admin</li>
  					<li><a href="admin/agent">Agents</a></li>
  					<li><a href="/admin/comments/">Comments</a></li>
  					<li class="active"><a href="/admin">Dashboard</a></l>
  					<li><a href="#">Reports</a></li>
  					<li><a href="#">Settings</a></l>
				</ul> 
                </div>
            </div>
            <div class="span9"> 
			
<form class="form-inline" method="get" action="/admin">
	<label for="from">From</label>
	<input type="text" id="from" name="from" />
	<label for="to">to</label>
	<input type="text" id="to" name="to" />
	<button type="submit" class="btn">Submit</button>
</form>			
				<table class="table table-striped table-condensed table-bordered">
					<thead>
						<tr>
							<th>Agent</th>
							<th>Ranking</th>
							<th>Count</th>
						</tr>
					</thead>
					<tbody>
						<?
						
						foreach ($reviews->result() as $row){
						?>
						<tr>
							<td><? if($row->name){
								echo $row->name;	
							}else{
								
								echo $row->agent;
							};
								?></td>
							<td><? echo $row->ranking; ?></td>
							<td><? echo $row->count; ?></td>
						</tr>
						<? };?>
					</tbody>
				</table>
				<h3>Desk.com Code</h3>
                <pre class="prettyprint linenums">{% if forloop.first %}<br />&lt;b&gt;Are you happy with this reply?&lt;/b&gt;&lt;br&gt;<br />  &lt;a href=&quot;http://www.joymetric.com/joy/metric/{{ site.subdomain }}/{{ case.id }}/{{ sender.id }}/Yes/<? echo $user_id; ?>&quot;&gt;Yes&lt;/a&gt; | &lt;a href=&quot;http://www.joymetric.com/joy/metric/{{ site.subdomain }}/{{ case.id }}/{{ sender.id }}/No/<? echo $user_id; ?>&quot;&gt;No&lt;/a&gt;&lt;br&gt;<br />  &lt;hr&gt;<br />{% endif %}</pre>
                            
            </div>
        </div>