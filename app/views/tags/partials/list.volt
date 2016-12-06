{% if mytag.getTaggedObjects('Playlists').count() %}
    <h2>列表 <span class="badge">{{ mytag.getTaggedObjects('Playlists').count() }}</span></h2>
    {% include 'playlists/partials/lists' with ['playlists':mytag.getTaggedObjects('Playlists')] %}
{% endif %}