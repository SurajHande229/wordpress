  #Security Headers

                # HSTS header (max-age: 1 year)
                add_header Strict-Transport-Security "max-age=31536000; includeSubDomains" always;

                # X-Frame-Options header
                add_header X-Frame-Options "SAMEORIGIN" always;


                # X-Content-Type-Options header
                add_header X-Content-Type-Options "nosniff" always;

                # Referrer-Policy header
                add_header Referrer-Policy "strict-origin";

                # Permissions-Policy header
                add_header Permissions-Policy "geolocation=(),midi=(),sync-xhr=(),microphone=(),camera=(),magnetometer=(),gyroscope=(),fullscreen=(self),payment=()";

                #Content Security Policy
                add_header Content-Security-Policy "default-src 'self'; script-src 'self'; object-src 'none'; style-src 'self' 'unsafe-inline'; img-src 'self' data:; media-src 'self'; frame-src 'self'; font-src 'self'; connect-src 'self' https://mydomain.in/";
