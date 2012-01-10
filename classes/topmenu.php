<?php

?>

<iframe id="josm_call_iframe" src="#" style="visibility:hidden;"></iframe>
<div id="topmenu2" style="position:absolute; top:10px; left:60px;">
	<ul class="dropdown">
		<li>
			<a href="http://openseamap.org/">
				<img src="../resources/icons/OpenSeaMapLogo_32.png" width="24" height="24" align="center" border="0" />
			</a>
		</li>
		<li>
			<a>
			<img src="./resources/action/find.png" width="22" height="22" align="center" border="0"  onClick="nominatim(document.getElementById('searchinputbox').value)"/>
			<input id="searchinputbox" name="searchtext" type="text"
				size="10" maxlength="40"
				style="height: 18px; border: 1px solid Black"
				onKeyPress="if (event.keyCode==13 || event.which==13) {nominatim(this.value);}"
			>
			</a>
		</li>
		<li>
			<a><img src="./resources/action/edit.png" width="22" height="22" align="center" border="0">&nbsp;<?=$t->tr("edit")?></a>
			<ul class="sub_menu">
				<li><a href="map_edit.php"><?=$t->tr("editMapOE")?></a></li>
				<li><a href="javascript:josm_call()"><?=$t->tr("editMapJOSM")?></a></li>
			</ul>
		</li>
		<li>
			<a><img src="./resources/action/view.png" width="22" height="22" align="center" border="0">&nbsp;<?=$t->tr("view")?></a>
			<ul class="sub_menu">
				<li><a href="weather.php"><img src="./resources/map/weather.png" width="24" height="24" align="center" border="0" />&nbsp;<?=$t->tr("weather")?></a></li>
				<li onClick="showSeamarks()"><a><input type="checkbox" id="checkLayerSeamark"/>&nbsp;<?=$t->tr("Seezeichen")?></a></li>
				<li onClick="showHarbours()"><a><input type="checkbox" id="checkLayerHarbour"/>&nbsp;<?=$t->tr("harbours")?></a></li>
				<li onClick="showTidalScale()"><a><input type="checkbox" id="checkLayerTidalScale"/>&nbsp;<?=$t->tr("tidalScale")?></a></li>
				<li onClick="showSport()"><a><input type="checkbox" id="checkLayerSport"/>&nbsp;Sport</a></li>
				<li onClick="showGridWGS()"><a><input type="checkbox" id="checkLayerGridWGS"/>&nbsp;<?=$t->tr("coordinateGrid")?></a></li>
				<li onClick="showGebcoDepth()"><a><input type="checkbox" id="checkLayerGebcoDepth"/>&nbsp;<?=$t->tr("gebcoDepth")?></a></li>
			</ul>
		</li>
		<li>
			<a><img src="./resources/action/tools.png" width="22" height="22" align="center" border="0">&nbsp;<?=$t->tr("tools")?></a>
			<ul class="sub_menu">
				<li onClick="showMapDownload()">
					<a><input type="checkbox" id="checkDownload"/>&nbsp;<img src="./resources/action/download.png" width="22" height="22" align="center" border="0" />&nbsp;<?=$t->tr("downloadChart")?></a>
				</li>
				<li onClick="showNauticalRoute()">
					<a><input type="checkbox" id="checkNauticalRoute"/>&nbsp;<IMG src="./resources/action/route-32px.png" width="22" height="22" align="center" border="0">&nbsp;<?=$t->tr("tripPlanner")?></img></a>
				</li>
			</ul>
		</li>
		<li>
			<a><img src="./resources/action/help.png" width="22" height="22" align="center" border="0">&nbsp;<?=$t->tr("help")?></a>
			<ul class="sub_menu">
				<li>
					<a><img src="./resources/action/help.png" width="22" height="22" align="center" border="0">&nbsp;<?=$t->tr("help")?></a>
					<ul class="sub_menu">
						<li onClick="showMapKey('help-online-editor')">
							<a><?=$t->tr("help-oe")?></a>
						</li>
						<li onClick="showMapKey('help-josm')">
							<a><?=$t->tr("help-josm")?></a>
						</li>
						<li onClick="showMapKey('help-tidal-scale')">
							<a><?=$t->tr("help-tidal-scale")?></a>
						</li>
						<li onClick="showMapKey('help-website')">
							<a><?=$t->tr("help-website-int")?></a>
						</li>
					</ul>
				</li>
				<li>
					<a><img src="./resources/action/info.png" width="22" height="22" align="center" border="0">&nbsp;<?=$t->tr("Legende")?></a>
					<ul class="sub_menu">
						<li onClick="showMapKey('harbour')">
							<a><?=$t->tr("harbour")?></a>
						</li>
						<li onClick="showMapKey('seamark')">
							<a><?=$t->tr("Seezeichen")?></a>
						</li>
						<li onClick="showMapKey('light')">
							<a><?=$t->tr("Leuchtfeuer")?></a>
						</li>
						<li onClick="showMapKey('lock')">
							<a><?=$t->tr("BrückenSchleusen")?></a>
						</li>
					</ul>
				</li>
				<li onClick="showMapKey('license')">
					<a><img src="./resources/action/Cc-sa-32px.png" width="22" height="22" align="center" border="0">&nbsp;<?=$t->tr("license")?></a>
				</li>
			</ul>
		</li>		
	</ul>
</div>
