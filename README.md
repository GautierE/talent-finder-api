# Talent Finder API
<h2>Overview</h2>
Talent Finder API is a web API designed to help companies find candidates for their job opportunities based on various criteria such as location, experience, skills, and salary requirements.

<h2>Technical Stack</h2>
<b>Technologies/Methodologies I am using for the first time are in bold characters</b>
  <ul>
  <br/>
<li>Backend : PHP</li>
<li>Backend Framework : Symfony 6</li>
<b>
<li>Hosting (app & database) : Platform.sh</li>
<li>TBD (Trunk-based development)</li>
<li>Conventional commits</li>
</b>
</ul>
<h2>API documentation</h2>
<ol>
    <li>
      Access
      <br/>
        API URL : https://master-7rqtwti-mi4wh3hot6kbg.fr-3.platformsh.site
      <br />
        API Platform : https://master-7rqtwti-mi4wh3hot6kbg.fr-3.platformsh.site/api
    </li>
    <li>
        <p>Route: <code>/candidate/generate</code></p>
        <ul>
            <li>Method: GET</li>
            <li>Description: Generate a random candidate.</li>
            <li>Request: Make a GET request to <code>/properties</code>.</li>
            <li>Response: Returns a JSON containing the generated candidate</li>
        </ul>
      <br />
         Note : this route was mainly meant to be used by myself to fill the database
    </li>
<li>
    <p>Route: <code>/candidate/match</code></p>
    <ul>
        <li>Method: POST</li>
        <li>Description: Match candidates based on job requirements.</li>
        <li>Request: Make a POST request to <code>/candidate/match</code> with a JSON payload containing the job requirements.</li>
        <li>Valid body example:
            <pre>
{
    "location": "Paris",
    "isremote": true,
    "experience": 3,
    "salary": 50000,
    "mainSkills": ["PHP", "JavaScript", "MySQL"],
    "secondarySkills": ["CSS", "HTML", "React"]
}
            </pre>
        </li>
        <li>Response: Returns an array of matched candidates, sorted by the best match first, as a JSON object. Each candidate contains the following information:
            <ul>
                <li><code>firstName</code>: First name of the candidate.</li>
                <li><code>lastName</code>: Last name of the candidate.</li>
                <li><code>email</code>: Email address of the candidate.</li>
                <li><code>experience</code>: Years of experience of the candidate.</li>
                <li><code>salary</code>: Expected salary of the candidate.</li>
                <li><code>location</code>: Preferred work location of the candidate.</li>
                <li><code>isRemote</code>: Indicates if the candidate is open to remote work (true/false).</li>
                <li><code>skills</code>: An array of skills possessed by the candidate. Each skill contains the skill name and its category.</li>
            </ul>
        </li>
    </ul>
</li>
</ol>
