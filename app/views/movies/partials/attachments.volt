<hr>
{% if movie.hasAttachments() %}
    <h2><a href="#">Attachments</a></h2>
    <div id="attachments">
        {% for attachment in movie.attachments() %}
            <table width="100%" border="1" cellpadding="0" cellspacing="0">
                <tbody><tr>
                    <td bgcolor="#FFFF33">id</td>
                    <td bgcolor="#FFFF33"><div align="center">文件下载</div></td>
                    <td bgcolor="#FFFF33"><div align="center">说明</div></td>
                    <td bgcolor="#FFFF33"><div align="center">上传时间</div></td>
                </tr>
                <tr>
                    <td rowspan="2"><a href="#" title="修改归属" target="_blank">{{ attachment.id }}</a></td>
                    <td><a href="#" target="_blank">下载</a></td>
                    <td>{{ attachment.name }}</td>
                    <td>{{ attachment.updated_at.diffForHumans() }}</td>
                </tr>
                <tr>
                    <td colspan="2">{{ attachment.present('getFileBaseName') }}</td>
                    <td>{{ attachment.present('getFileSize') }}</td>
                </tr>
                </tbody>
            </table>
        {% endfor %}
    </div>
{% endif %}
<div class="fileUpload" id="fileUpload">
    <form action="{{ url(['for':'movies.addAttachment','movie':movie.id]) }}"
          id="my-awesome-dropzone">
        文件上传:<br>请将文件拖拽到这里
    </form>
</div>
<script src="/js/dropzone.js"></script>
<script src="/js/movie.js"></script>