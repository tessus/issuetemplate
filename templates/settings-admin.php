<div id="issuetemplate" class="section">
	<h2 class="inlineblock"><?php p($l->t('Issue reporting')); ?></h2>
		<div>

			<form-wizard @on-complete="onComplete"
						 shape="tab"
						 color="<?php p(\OC::$server->getThemingDefaults()->getColorPrimary()); ?>"
						 error-color="#a94442"
						 ref="wizard">
				<div slot="title"></div>


				<tab-content title="Affected component" icon="icon-category-customization icon-invert" :before-change="validateAppSelect">
					<app-selector v-on:select="selectComponent"></app-selector>
				</tab-content>

				<tab-content title="Issue description" icon="icon-user icon-invert" :before-change="validateIssueDescription">
					<vue-form-generator :model="model" :schema="firstTabSchema" :options="formOptions" ref="firstTabForm"></vue-form-generator>
				</tab-content>

				<tab-content v-for="tab in tabs" v-if="model.component" :key="tab.identifier" :title="tab.title" icon="icon-settings icon-invert" :before-change="()=>validateDetails(tab)">
					<detail-section :app="getAppId()" :section="tab.identifier" :ref="tab.identifier" :model="model"></detail-section>
				</tab-content>

				<tab-content title="Check issue report" icon="icon-checkmark icon-invert" v-if="tabs.length">
					<h4>Check your bug report before submitting it</h4>
					<div class="panel-body">
						<p>
							<strong><?php p($l->t("Please always check if the automatically filled out information is correct and there is nothing important missing, before reporting the issue.")); ?></strong>
						</p>

						<p>
							<strong><?php p($l->t("This report will be submitted to nextcloud/server")); ?></strong>
						</p>
					</div>
				</tab-content>

			</form-wizard>


		</div>

		<p>
			<?php p($l->t("For reporting potential security issues please see")); ?>
			<a href="https://nextcloud.com/security/">https://nextcloud.com/security/</a>
		</p>

		<h3>Debug output</h3>
		<pre v-if="model" v-html="prettyJSON(model)"></pre>
</div>


