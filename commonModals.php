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
                <p>In order to handle large city maps, in which the layer can include many OSM elements, 
                an R-tree structure to index objects has been implemented. 
                The R-tree structure is based as usual on MBR's (<b>Minimum Bounding Rectangles</b>) to hierarchically 
                organize the content of an OSM map, and they are also used to enclose in leaves nodes and ways of OSM.
                </p>
                <p>A database will be generated for spatial, keyword and aggregation queries.</p>
              </span>
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
                    <code>isIn(s1,s2), isNext(s1,s2), isAway(s1,s2)</code></li>
                    <li>Based on Latitude and Longitude<br/>
                      <code>furtherNorthPoints(p1,p2), furtherSouthPoints(p1,p2), furtherEastPoints(p1,p2), furtherWestPoints(p1,p2), furtherNorthWays(s1,s2), furtherSouthWays(s1,s2), furtherEastWays(s1,s2), furtherWestWays(s1,s2)</code></li>
                </ul>
                <li><b>Clementini based OSM Operators</b></li>
                <code>inWay(p,s), inSameWay(p1,p2), intersectionPoint(s1,s2), isCrossing(s1,s2), isParallel(s1,s2), isEndingTo(s1,s2), isContinuationOf(s1,s2)</code>
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
                <li><code>addTag(osmElement,kValueToAdd,vValueToAdd)</code></li>
                <li><code>removeTag(osmElement,kValueToRemove,vValueToRemove)</code></li>
                <li><code>replaceTag(osmElement,kValueToReplace,vValueToReplace)</code></li>
                <li><code>searchOneTag(osmElement,valueToSearch)</code></li>
                <li><code>searchTags(osmElement,collectionValueToSearch)</code></li>
              </ul>
            </div>
            <div role="tabpanel" class="tab-pane" id="menuAggregation">
              <p>
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

              </p>
              <h3>Aggregation OpenStreetMap Operators</h3>
              <ul>
                <li><b>Distributive Operators</b></li>
                <ul>
                  <li><code>topologicalCount(osmElements,osmElement,topologicalRelation)</code></li>
                  <li><code>metricMin(osmElements,metricOperator)</code></li>
                  <li><code>metricMax(osmElements,metricOperator)</code></li>
                  <li><code>metricSum(osmElements,metricOperator)</code></li>
                  <li><code>minDistance(osmElements)</code></li>
                  <li><code>maxDistance(osmElements)</code></li>
                </ul>
                <li><b>Algebraic Operators</b></li>
                <ul>
                  <li><code>metricAvg(osmElements,metricOperator)</code></li>
                  <li><code>avgDistance(osmElements)</code></li>
                  <li><code>metricStdev(osmElements,metricOperator)</code></li>
                  <li><code>metricTopCount(osmElements,metricOperator,k)</code></li>
                  <li><code>metricBottomCount(osmElements,metricOperator,k)</code></li>
                  <li><code>TopCountDistance(osmElements,k)</code></li>
                  <li><code>BottomCountDistance(osmElements,k)</code></li>
                </ul>
                <li><b>Holistic Operators</b></li>
                <ul>
                  <li><code>metricMedian(osmElements,metricOperator)</code></li>
                  <li><code>metricMode(osmElements,metricOperator)</code></li>
                  <li><code>metricRank(osmElements,metricOperator)</code></li>
                  <li><code>metricRange(osmElements,metricOperator)</code></li>
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