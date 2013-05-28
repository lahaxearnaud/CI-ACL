CI-ACL
========

Simple ACL for the codeigniter Framework. Need <a href="https://github.com/benedmunds/CodeIgniter-Ion-Auth" >Ion auth</a> to be installed in your application.


Requires
========
<a href="https://github.com/benedmunds/CodeIgniter-Ion-Auth" >Ion auth</a>
For the display exemple : Bootstrap + jQuery. 


Installation
========

Add all files in your codeigniter installation, execute the SQL script in your MySQL installation and set in your application/conf/config.php: <br/>$config['enable_hooks'] = TRUE;<br/>

Now you can access to the page http://YOUR_URL/index.php/droit to set your ACLs.

In the HTML code your can call the helper : isAllow($ctrl,$ssctrl="*") to know if you may display a link or not.<br/>

For example : <br/>

<?php if(isAllow('admin','activate')){ ?>
	&lt;a  href=&quot;&lt;?php echo site_url(&#39;admin/activate&#39;); ?&gt;&quot; &gt;Activate&lt;/a&gt;
<?php } ?>

License 
========
<a href='http://opensource.org/licenses/MIT'>MIT</a>
<br/>
THIS SOFTWARE IS PROVIDED BY THE COPYRIGHT HOLDERS AND CONTRIBUTORS "AS IS" 
AND ANY EXPRESS OR IMPLIED WARRANTIES, INCLUDING, BUT NOT LIMITED TO, THE IMPLIED 
WARRANTIES OF MERCHANTABILITY AND FITNESS FOR A PARTICULAR PURPOSE ARE DISCLAIMED. 
IN NO EVENT SHALL THE COPYRIGHT OWNER OR CONTRIBUTORS BE LIABLE FOR ANY DIRECT, 
INDIRECT, INCIDENTAL, SPECIAL, EXEMPLARY, OR CONSEQUENTIAL DAMAGES (INCLUDING, BUT 
NOT LIMITED TO, PROCUREMENT OF SUBSTITUTE GOODS OR SERVICES; LOSS OF USE, DATA, OR 
PROFITS; OR BUSINESS INTERRUPTION) HOWEVER CAUSED AND ON ANY THEORY OF LIABILITY, 
WHETHER IN CONTRACT, STRICT LIABILITY, OR TORT (INCLUDING NEGLIGENCE OR OTHERWISE) 
ARISING IN ANY WAY OUT OF THE USE OF THIS SOFTWARE, EVEN IF ADVISED OF THE POSSIBILITY
OF SUCH DAMAGE.
<br/>
Developed by LAHAXE Arnaud