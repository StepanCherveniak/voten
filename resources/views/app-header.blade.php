<header class="header-voten user-select" :class="{ 'v-blur v-blur-wrapper': smallModal }">
	<div class="left-header">
		<vui-menu-button :checked="sidebar"></vui-menu-button>
	</div>

    <router-link :to="{ path: '/' }" class="desktop-only">
        <img src="/imgs/voten-beta.svg" alt="Voten" @click="homeRoute" class="logo-voten">
    </router-link>

    <div class="flex-display">
        <div class="dropdown head-notification-icons">
        	@if(Auth::check())
				<button type="button" class="btn-nth relative" id="messages-btn" @click="changeRoute('messages')" v-tooltip="{content:'Messages', offset: 8}">
	                <i class="v-icon v-inbox" aria-hidden="true"></i>
	                <span class="queue-number" v-show="unreadMessages" v-text="unreadMessages"></span>
	            </button>

	            <button type="button" class="btn-nth relative" v-tooltip="{content:'Notifications', offset: 8}" @click="changeRoute('notifications')">
	           		<i class="v-icon v-bell-2" aria-hidden="true"></i>
	               	<span class="queue-number" v-show="unreadNotifications" v-text="unreadNotifications"></span>
	            </button>
        	@endif

        	@if (!Auth::check())
        		<button class="v-button v-button--green relative" @click="mustBeLogin">
	        		Sign up/Log in
	        	</button>
        	@endif

            <button type="button" class="btn-nth relative"  v-tooltip="{content:'Search', offset: 8}" @click="changeRoute('search')">
           		<i class="v-icon v-search-3" aria-hidden="true"></i>
            </button>

			<router-link :to="'/'" class="btn-nth relative" v-tooltip="{content:'Home', offset: 8}">
           		<i class="v-icon v-home" aria-hidden="true" @click="homeRoute"></i>
            </router-link>

			@if(optional(Auth::user())->isVotenAdministrator())
				<a href="/backend" class="btn-nth relative margin-right-half">
					<i class="v-icon v-dashboard" aria-hidden="true"></i>
				</a>
			@endif
        </div>

		@if(Auth::check())
	        <div class="ui icon top right green pointing dropdown pull-right" id="more-button">
				<i class="v-icon v-more-vertical"></i>

	            <div class="menu">
	                <div class="header">My Voten</div>

					<router-link :to="'/' + '@' + auth.username" class="item">
	                    Profile
	                </router-link>

					<router-link :to="'/submit'" class="item">
	                    Submit
	                </router-link>

	                <router-link :to="{ path: '/bookmarks' }" class="item">
	                    Bookmarks
	                </router-link>

					<router-link :to="{ path: '/subscribed-channels' }" class="item">
	                    Subscribed Channels
	                </router-link>

					<router-link :to="'/find-channels'" class="item">
						Find Channels
					</router-link>

	    			<router-link :to="'{{ '/@' . Auth::user()->username }}/settings'" class="item">
	                    Settings
	                </router-link>

					<router-link :to="'/channel'" class="item">
	                    Create a new Channel
	                </router-link>

	                <div class="ui divider"></div>

					@if(!isMobileDevice())
						<div class="header" v-if="Store.moderatingCategories.length">Moderating Channels</div>
						<router-link :to="'/c/' + item.name" class="item" v-for="(item, index) in Store.moderatingCategories"
									 :key="item.id" v-if="Store.moderatingCategories.length && index < 6">
							<img class="square" :src="item.avatar" :alt="item.name">
							@{{ item.name }}
						</router-link>
						<div class="ui divider" v-if="Store.moderatingCategories.length && Store.moderatingCategories.length < 6"></div>

						<div class="item" v-if="Store.moderatingCategories.length && Store.moderatingCategories.length > 6">
							<i class="v-icon v-more"></i>

							<div class="left menu">
								<router-link :to="'/c/' + item.name" class="item" v-for="(item, index) in Store.moderatingCategories"
											 :key="item.id" v-if="index > 6">
									<img class="square" :src="item.avatar" :alt="item.name">
									@{{ item.name }}
								</router-link>
							</div>
						</div>
						<div class="ui divider" v-if="Store.moderatingCategories.length && Store.moderatingCategories.length > 6"></div>
					@endif

	                <a class="item desktop-only" @click="changeModalRoute('keyboard-shortcuts-guide')">
	                    Keyboard Shortcuts
	                </a>

	                <router-link :to="'/help'" class="item">
	                    Help
	                </router-link>

					<div class="item">
						<span>&#8592; Voten</span>

						<div class="left menu green">
							<a href="/about" class="item">
			                    About
			                </a>

			                <a href="mailto:info@voten.co" class="item">
			                    Contact Us
			                </a>

			                <router-link class="item" to="/feedback">
			                    Feedback
			                </router-link>

			                <a class="item" href="https://voten.co/tos">
			                    Site Rules
			                </a>

			                <a class="item" href="https://voten.co/privacy-policy">
			                    Privacy Policy
			                </a>

							<a href="https://medium.com/voten" class="item">
			                    Blog
			                </a>

							<a href="/credits" class="item">
			                    Credits
			                </a>

			                <a href="https://github.com/voten-co/voten" class="item" target="_blank">
			                    Source Code
			                </a>

							<a href="https://join.slack.com/t/voten/shared_invite/MjMzMTQxMzM4MDM2LTE1MDM5OTQ0NjEtMWRiMDhiZTY2Yg" class="item" target="_blank">
			                    Slack
			                </a>
						</div>
					</div>

	                <a href="/logout" class="item">
	                    Logout
	                </a>
	            </div>
	        </div>
		@endif
    </div>
</header>
