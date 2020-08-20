{if $analytics}
    <div class="sidebar-row">
        <h6>Analytics</h6>
        {foreach $analytics as $analytic}
            <div class="profile-info">
                <i class="icon-tag"></i>
                <p><strong>Source:</strong> {$analytic.utm_source}</p>
                <p><strong>Campaign:</strong> {$analytic.utm_campaign}</p>
                <p><strong>Medium:</strong> {$analytic.utm_medium}</p>
                <p><strong>User agent:</strong> {$analytic.browser}</p>
            </div>
        {/foreach}
    </div>
{/if}