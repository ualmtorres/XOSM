<!-- Modal -->
<div class="modal fade" id="indexing" tabindex="-1" role="dialog" aria-labelledby="myModalLabel">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h3 class="modal-title">Indexing Map Objects</h3>
      </div>
      <div class="modal-body">
        <div class="loader" data-initialize="loader"></div>
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-primary" data-dismiss="modal">OK</button>
      </div>
    </div>
  </div>
</div>
<!--
<div class="modal fade" id="loader" tabindex="-1" role="dialog" aria-labelledby="myModalLabel">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h3 class="modal-title">Running Query</h3>
      </div>
      <div class="modal-body">
        <div class="loader" data-initialize="loader"></div>
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-primary" data-dismiss="modal">OK</button>
      </div>
    </div>
  </div>
</div>
-->

<div class="modal fade" id="loader" tabindex="-1" role="dialog" aria-labelledby="myModalLabel">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h3 class="modal-title">
          <div id="loaderTitle"></div>
        </h3>
      </div>
      <div class="modal-body">
        <div class="loader" data-initialize="loader">
          <div id="loaderBody"></div>
        </div>
      </div>
    </div>
  </div>
</div>

<!-- Modal -->
<div class="modal fade" id="showOSM" tabindex="-1" role="dialog" aria-labelledby="myModalLabel">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-header">
      	<button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
        <h3 class="modal-title">OSM data</h3>
      </div>
      <div class="modal-body">
      	<code>
      		<div id="osmData">
      		</div>
      	</code>
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-primary" data-dismiss="modal">OK</button>
      </div>
    </div>
  </div>
</div>

<!-- Modal -->
<div class="modal fade" id="modalAlert" tabindex="-1" role="dialog" aria-labelledby="myModalLabel">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
        <h3 class="modal-title">
          <div id="modalAlertTitle"></div>
        </h3>
      </div>
      <div class="modal-body">
        <p>
          <div id="modalAlertBody"></div>
        </p>
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-primary" data-dismiss="modal">OK</button>
      </div>
    </div>
  </div>
</div>


<!-- Modal -->
<div class="modal fade" id="contactUs" tabindex="-1" role="dialog" aria-labelledby="myModalLabel">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
        <h3 class="modal-title">Project Team</h3>
      </div>
      <div class="modal-body app-modal-body">
        Jesús Manuel Almendros-Jimenez <a href="mailto:jalmen@ual.es">jalmen@ual.es</a><br/>
        Antonio Becerra-Terón <a href="mailto:abecerra@ual.es">abecerra@ual.es</a><br/>
        Manuel Torres <a href="mailto:mtorres@ual.es">mtorres@ual.es</a><br/><br/>
        Departamento de Informatica (<a href="http://www.ual.es">University of Almería)</a><br/>
        04120 Almería (Spain)
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-primary" data-dismiss="modal">OK</button>
      </div>
    </div>
  </div>
</div>

<!-- Modal -->
<div class="modal fade" id="infoModal" tabindex="-1" role="dialog" aria-labelledby="myModalLabel">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
        <h3 class="modal-title" id="myModalLabel">Spatial OpenStreetMap Queries</h3>
      </div>
      <div class="modal-body">
          <!-- Nav tabs -->
          <ul class="nav nav-tabs" role="tablist">
            <li role="presentation" class="active"><a href="#menuIndex" aria-controls="profile" role="tab" data-toggle="tab">Index</a></li>
            <li role="presentation"><a href="#menuSpatial" aria-controls="profile" role="tab" data-toggle="tab">Spatial</a></li>
            <li role="presentation"><a href="#menuKeyword" aria-controls="messages" role="tab" data-toggle="tab">Keyword</a></li>
            <li role="presentation"><a href="#menuAggregation" aria-controls="messages" role="tab" data-toggle="tab">Aggregation</a></li>
          </ul>

          <!-- Tab panes -->
          <div class="tab-content">
            <div role="tabpanel" class="tab-pane active" id="menuIndex">
              <span>
                In order to handle large city maps, in which the layer can include many OSM elements, 
                an R-tree structure to index objects has been implemented. 
                The R-tree structure is based as usual on MBR's (<b>Minimum Bounding Rectangles</b>) to hierarchically 
                organize the content of an OSM map, and they are also used to enclose in leaves nodes and ways of OSM.<br/><br/>
                A database will be generated for spatial, keyword and aggregation queries.
              </span>
              <h3>Index Operators</h3>
              <ul>
                <li><code>xosm_rtj:getLayerByName(map, name, distance)</code></li>
                <li><code>xosm_rtj:getLayerByElement(map, osmElement, distance)</code></li>
                <li><code>xosm_rtj:getElementByName(map, name)</code></li>
                <li><code>xosm_rtj:getElementsByKeyword(map, keyword)</code></li>
              </ul>
            </div> 
            <div role="tabpanel" class="tab-pane" id="menuSpatial">
              <span>In our library, we have proposed and designed a repertoire of Spatial Operators, 
                suitable for OSM maps; that is, it handles the particular nature of the XML representation of OSM, 
                as well as it is designed to be able to check specific spatial relationships over elements in OSM maps. 
                Spatial Operators will allow us to express Geo-Localized Queries over OSM layers, by means of two kind of operators: Coordinate based OSM Operators and 
                Clementini based OSM Operators
              </span>
              <h3>Spatial OpenStreetMap Operators</h3>
              <ul>
                <li><b>Coordinate based OSM Operators</b></li>
                <ul>
                  <li>Based on Distance<br/>
                    <code>xosm_sp:isIn(s1,s2), xosm_sp:DWithin(s1,s2,d)</code></li>
                    <li>Based on Latitude and Longitude<br/>
                      <code>xosm_sp:furtherNorthPoints(p1,p2), xosm_sp:furtherSouthPoints(p1,p2), xosm_sp:furtherEastPoints(p1,p2), xosm_sp:furtherWestPoints(p1,p2), xosm_sp:furtherNorthWays(s1,s2), xosm_sp:furtherSouthWays(s1,s2), xosm_sp:furtherEastWays(s1,s2), xosm_sp:furtherWestWays(s1,s2)</code></li>
                </ul>
                <li><b>Clementini based OSM Operators</b></li>
                <code>xosm_sp:wayIn(p,s), xosm_sp:waySame(p1,p2), xosm_sp:intersectionPoint(s1,s2), xosm_sp:crossing(s1,s2), xosm_sp:nonCrossing(s1,s2), xosm_sp:endsAt(s1,s2), xosm_sp:continuationOf(s1,s2)</code>
              </ul>
            </div>
            <div role="tabpanel" class="tab-pane" id="menuKeyword">
              <span>In our library, we have proposed and designed a repertoire of Keyword Operators, 
                  suitable for OSM maps; that is, it handles the particular nature of the XML representation of OSM, 
                  as well as it is designed to be able to check the textual features of OSM elements. 
                  Keyword Operators will allow us to manipulate pairs <b>@k</b> and <b>@v</b> in XML tags <b>tag</b>
              </span>
              <h3>Keyword OpenStreetMap Operators</h3>
              <ul>
                <li><code>xosm_kw:searchKeyword(osmElement,keyword)</code></li>
                <li><code>xosm_kw:searchKeywordSet(osmElement,(keyword1,...., keywordn))</code></li>
                <li><code>xosm_kw:searchTag(osmElement, kValue, vValue)</code></li>
                <li><code>xosm_kw:getTag(osmElement, kValue)</code></li>
              </ul>
            </div>
            <div role="tabpanel" class="tab-pane" id="menuAggregation">
                Here, we will show the proposed operators in our library for expressing aggregation queries. 
                   The aggregation operators are inspired by the SOLAP operators. They consider two levels of operators. 
                   <ul>
                    <li>The first level includes Numeric-Spatial and Numeric-Multidimensional operators. Numeric-Spatial operators 
                   can be topological (boolean (i.e., one-zero) Clementini’s operators), 
                   and metric (area,length, perimeter and distance), while Numeric-Multidimensional 
                   are max, min, sum, count and distinct count, among others.</li>
                   <li>A second level is defined from the first level and it enables the retrieval 
                   of objects according to the corresponding numeric values. </li>
                 </ul>
                 Additionally, Numeric-Multi dimensional 
                   operators can be classified by Distributive, Algebraic or Holistic. 
                   <ul>
                    <li>An aggregate function 
                   is Distributive if it can be computed in a distributed manner, that is, the result 
                   derived by applying the function to the n aggregate values is the same as that derived by applying
                   the function to the entire data set (without parti- tioning). </li>
                   <li>An aggregate function 
                   is Algebraic if it can be computed by an algebraic function with m 
                   arguments (where m is a bounded positive integer), each of which is 
                   obtained by applying a distributive aggregate function. </li>
                   <li>An aggregate 
                   function is Holistic when there does not exist an algebraic function with m arguments that characterizes the computation.</li>
                 </ul>
              <h3>Aggregation OpenStreetMap Operators</h3>
              <ul>
                <li><b>Distributive Operators</b></li>
                <ul>
                  <li><code>xosm_ag:topologicalCount(osmElements,osmElement,topologicalRelation)</code></li>
                  <li><code>xosm_ag:metricMin(osmElements,metricOperator)</code></li>
                  <li><code>xosm_ag:metricMax(osmElements,metricOperator)</code></li>
                  <li><code>xosm_ag:metricSum(osmElements,metricOperator)</code></li>
                  <li><code>xosm_ag:minDistance(osmElements, osmElement)</code></li>
                  <li><code>xosm_ag:maxDistance(osmElements, osmElement)</code></li>
                </ul>
                <li><b>Algebraic Operators</b></li>
                <ul>
                  <li><code>xosm_ag:metricAvg(osmElements,metricOperator)</code></li>
                  <li><code>xosm_ag:avgDistance(osmElements, osmElement)</code></li>
                  <li><code>xosm_ag:metricStdev(osmElements,metricOperator)</code></li>
                  <li><code>xosm_ag:metricTopCount(osmElements,metricOperator,k)</code></li>
                  <li><code>xosm_ag:metricBottomCount(osmElements,metricOperator,k)</code></li>
                  <li><code>xosm_ag:topCountDistance(osmElements, k, osmElement)</code></li>
                  <li><code>xosm_ag:bottomCountDistance(osmelement, k, osmElement)</code></li>
                </ul>
                <li><b>Holistic Operators</b></li>
                <ul>
                  <li><code>xosm_ag:metricMedian(osmElements,metricOperator)</code></li>
                  <li><code>xosm_ag:metricMode(osmElements,metricOperator)</code></li>
                  <li><code>xosm_ag:metricRank(osmElements,metricOperator)</code></li>
                  <li><code>xosm_ag:metricRange(osmElements,metricOperator)</code></li>
                </ul>
              </ul>
            </div>        
          </div>
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-primary" data-dismiss="modal">OK</button>
      </div>
    </div>
  </div>
</div>